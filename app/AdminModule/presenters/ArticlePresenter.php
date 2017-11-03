<?php
namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ArticleForm\ArticleFormControl;
use App\AdminModule\Components\ArticleForm\ArticleFormControlFactory;
use App\AdminModule\Components\Grid\GridControlFactory;
use App\AdminModule\Components\ImageUpload\ImageUploadControl;
use App\AdminModule\Components\ImageUpload\ImageUploadControlFactory;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryArticleRepository;
use Tracy\Debugger;

class ArticlePresenter extends BasePresenter
{
    /** @var ArticleFormControlFactory @inject */
    public $articleFormControlFactory;

    /** @var CategoryArticleRepository */
    public $categoryArticleRepository;

    /** @var ArticleRepository */
    public $articleRepository;

    /** @var ImageUploadControlFactory @inject */
    public $imageUploadControlFactory;

    /** @var GridControlFactory */
    private $gridControlFactory;

    public function __construct(
        CategoryArticleRepository $categoryArticleRepository,
        ArticleRepository $articleRepository,
        GridControlFactory $gridControlFactory
    )
    {
        $this->categoryArticleRepository = $categoryArticleRepository;
        $this->articleRepository = $articleRepository;
        $this->gridControlFactory = $gridControlFactory;
    }

    public function handleUpdate($image_id, $article_id)
    {
        $this->articleRepository->update(['id' => $article_id], ['image_id' => $image_id]);
        $this->flashMessage('success');
        if($this->isAjax()){
            $this->redrawControl('images');
            $this->redrawControl('flash');
        }else{
            $this->redirect('this');
        }
    }

    public function renderDefault()
    {
        $this->template->articles = $this->articleRepository->find([], 'id ASC', 30);
    }

    public function renderEdit($id)
    {
        $article = $this->articleRepository->get(['id' => $id]);
        $this->template->id = $id;
        $this->template->article = $article;
        $this->template->path = IMAGES_PATH . "/articles/";
    }



    public function handleDelete($id)
    {
        $categoryArticle = $this->categoryArticleRepository->find(['article_id' => $id]);
        if ($categoryArticle) {

            foreach ($categoryArticle as $article) {
                $this->categoryArticleRepository->delete(['id' => $article->id]);
            }
        }
            $this->articleRepository->delete(['id' => $id]);

        if ($this->isAjax()) {
            $this->redrawControl('article');
        } else {
            $this->redirect('this');
        }

    }

    /**
     * Create ArticleForm component
     *
     * @return ArticleFormControl
     */
    protected function createComponentArticleForm(): ArticleFormControl
    {
        return $this->articleFormControlFactory->create();
    }

    /**
     * @return ImageUploadControl
     */
    protected function createComponentImageUpload(): ImageUploadControl
    {
        $id = $this->presenter->getParameter('id');
        $article = $this->articleRepository->get(['id' => $id]);

        $repository = $this->articleRepository;
        $renderPath = IMAGES_PATH . "/articles/";
        $articleRelationTitle = "article_image";
        $articleId = "article_id";
        $typeParent = "Article";
        $savingPath = SAVING_PATH . "/articles/";
        $relationRepository = $this->categoryImageRepository;

        return $this->imageUploadControlFactory->create($renderPath, $repository, $article, $articleRelationTitle, $articleId, $typeParent, $savingPath, $relationRepository);
    }

    protected function createComponentGrid()
    {
        $repository = $this->articleRepository;
        $category_id = "article_id";
        $articleRelationTitle = "article_image";
        $link = "Article";

        return $this->gridControlFactory->create($repository, $category_id, $articleRelationTitle, $link);

    }


}