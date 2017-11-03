<?php

namespace App\AdminModule\Components\CategoryForm;

use App\AdminModule\Components\BaseControl;
use App\Repositories\CategoryImageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Nette\Utils\Html;
use Nette\Utils\Strings;


interface CategoryFormControlFactory
{
    /** @return CategoryFormControl */
    public function create();
}

class CategoryFormControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;
    private $imageRepository;
    private $relationsRepository;
    /** @var CategoryImageRepository @inject */
    public $categoryImageRepository;

    /** @var array $images */
    private $images = [];

    /** @var int $categoryId */
    private $categoryId;


    public function __construct(
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        RelationsRepository $relationsRepository,
        CategoryImageRepository $categoryImageRepository
    )
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->categoryImageRepository = $categoryImageRepository;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/CategoryForm.latte');
        $template->render();
    }

    /**
     * Component category form
     *
     * @return Form
     */
    protected function createComponentCategoryForm()
    {
        $id = $this->presenter->getParameter('id');

        $this->categoryId = $id;
        $getCategory = $this->categoryRepository->get(['id' => $id]);

        $findTitles = $this->categoryRepository->findPairs('title', 'id', [], 'id ASC', 50, null);

        $form = new Form;
        $form->addText('title', 'Titulok:')
            ->setRequired('Titulok musí byť vložený');
        $form->addText('slug', 'Slug:');

        $form->addMultiSelect('parent_id', 'Kategorizacia', $findTitles);
        $form->addTextArea('content', 'Obsah:')
            ->setRequired(FALSE);

        $form->setDefaults([
            'title' => $getCategory['title'],
            'parent_id' => $getCategory['parent_id'],
            'slug' => $getCategory['slug'],
            'content' => $getCategory['content'],
        ]);

        $form->addSubmit('send', 'Uložiť do databazy');

        $form->onSuccess[] = [$this, 'onSubmit'];
        return $form;
    }

    public function onSubmit(UI\Form $form, $values)
    {
        $path = 'categories';
        $parent_id = $values['parent_id'];

        if ($parent_id) {
            $parent = $values['parent_id'];
        } else {
            $parent = null;
        }

        $category = [
            'title' => $values['title'],
            'content' => $values ['content'],
            'slug' => $values['slug'] !== "" ? Strings::webalize($values['slug']) : Strings::webalize($values['title']),
            'parent_id' => $parent
        ];

        $categoryId = $this->presenter->getParameter('id');

        if ($categoryId) {
            $this->categoryRepository->update(['id' => $categoryId], $category);
            $this->categoryRepository->update(['id' => $categoryId], ['updated_at' => date('Y-m-d G:i:s')]);
        } else {
            $value = $this->categoryRepository->create($category);
            $categoryId = $value->id;
        }

        $this->presenter->flashMessage("Uložené v databáze");
        $this->presenter->redirect('this');

    }

    public function createHtmlArray($array)
    {
        $newArray = [];
        foreach ($array as $item) {
            $this->images[] = $item['img_id'];
            $el = Html::el('span')
                ->addHtml(Html::el('img')->addAttributes(['src' => $item['img_path']]))
                ->addHtml(Html::el('a')->href('/admin/image/edit/' . $item['img_id'])->setText('Edit')
                    ->addHtml(Html::el('a')->href('?image_id=' . $item['img_id'] . '&category_id=' . $this->categoryId . '&do=update')->setText('Set as main image')));

            $newArray[$item['img_id']] = $el;

        }

        return $newArray;
    }
}
