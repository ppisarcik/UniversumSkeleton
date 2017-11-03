<?php

namespace App\AdminModule\Components\ArticleForm;


use App\Components\BaseControl;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Nette\Utils\Strings;

interface ArticleFormControlFactory
{
    /**
     * @return ArticleFormControl
     */
    public function create();
}

class ArticleFormControl extends BaseControl
{
    /** @var ArticleRepository */
    private $articleRepository;
    /** @var CategoryRepository */
    private $categoryRepository;
    /** @var RelationsRepository */
    private $relationsRepository;
    /** @var RelationsRepository */
    private $imageRepository;


    public function __construct(
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        RelationsRepository $relationsRepository,
        ImageRepository $imageRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->imageRepository = $imageRepository;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/ArticleForm.latte');
        $template->render();
    }

    protected function createComponentArticleForm(): Form
    {

        $id = $this->presenter->getParameter('id');
        $getArticle = $this->articleRepository->get(['id' => $id]);
        $getCategories = $this->categoryRepository->findPairs('title', 'id', [], 'id ASC');

        $form = new Form;
        $form->addText('title', 'Titulok:')
            ->setRequired('Titulok musí byť vložený');
        $form->addTextArea('description', 'Opis');
        $form->addTextArea('content', 'Obsah')
            ->setRequired(FALSE);
        $form->addText('slug', 'Slug:');
        $form->addSelect('categories', 'Kategórie', $getCategories)
            ->setPrompt('Nezaradené');
        $form->addMultiUpload('image', 'Pridať ďalšie obrázky:')
            ->setRequired(FALSE)
            ->addRule(Form::IMAGE, 'Avatar musí být JPEG, PNG nebo GIF.')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je %d kB.', 6000 * 1024);
        $form->addTextArea('alt', 'Vložiť popis obrázka');

        if ($getArticle) {
            $getRelCategory = $getArticle->related('category')->fetch();
            $form->setDefaults([
                'title' => $getArticle['title'],
                'slug' => $getArticle['slug'],
                'description' => $getArticle['description'],
                'content' => $getArticle['content'],
                'categories' => $getRelCategory['category_id']
            ]);
        }
        $form->addSubmit('send', 'Uložiť do databazy');
        $form->onSuccess[] = [$this, 'onSubmit'];
        return $form;
    }

    public function onSubmit(UI\Form $form, $values)
    {
        /*Image array*/
        $image = $values->image;

        /*path for upload images*/
        $path = 'articles';

        /*Article value*/
        $article = [
            'title' => $values['title'],
            'description' => $values['description'],
            'content' => $values['content'],
            'slug' => $values['slug'] !== "" ? Strings::webalize($values['slug']) : Strings::webalize($values['title'])
        ];
        /*Get id from editing page*/
        $articleId = $this->presenter->getParameter('id');

        /*Get article from db*/
        $getArticle = $this->articleRepository->get(['id' => $articleId]);

        if ($getArticle) {
            $getRelCategory = $getArticle->related('category')->fetch();
        }

        /*If has id then update changes else insert new data to db*/
        if ($articleId) {
            $this->articleRepository->update(['id' => $articleId], $article);
            $this->articleRepository->update(['id' => $articleId], ['updated_at' => date('Y-m-d G:i:s')]);
            $attach = false;
        } else {
            $value = $this->articleRepository->create($article);
            $newArticleId = $value->id;
            $attach = true;
        }

        if ($values->categories) {

            $category_article = [
                'article_id' => $newArticleId ?? $articleId,
                'category_id' => $values['categories']
            ];

            if ($attach) {
                $this->relationsRepository->attach('category_article', $category_article);
            } else {

                if ($getRelCategory['id'] == null) {
                    $this->relationsRepository->attach('category_article', $category_article);
                }
                $this->relationsRepository->updateRelation('category_article', $category_article, ['id' => $getRelCategory['id']]);

            }
        } else if ($getArticle) {
            $this->relationsRepository->deleteRelation('category_article', ['article_id' => $getArticle]);
        }

        $imageId = $this->imageRepository->upload($image, $values, $path);

        /*Relation article_image table*/
        foreach ($imageId as $value) {
            $articleImage = [
                'article_id' => $newArticleId ?? $articleId,
                'image_id' => $value['id']
            ];

            $this->relationsRepository->attach('article_image', $articleImage);
        }

        $this->presenter->flashMessage("Uložené v databáze");
        $this->presenter->redirect('this');

    }

}
