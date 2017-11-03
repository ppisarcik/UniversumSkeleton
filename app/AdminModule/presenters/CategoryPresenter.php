<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Components\CategoryForm\CategoryFormControlFactory;
use App\AdminModule\Components\Grid\GridControlFactory;
use App\AdminModule\Components\ImageUpload\ImageUploadControlFactory;
use App\Repositories\CategoryArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\TemplatesRepository;
use App\AdminModule\Components\ImageUpload\ImageUploadControl;

class CategoryPresenter extends BasePresenter
{
    /** @var CategoryFormControlFactory @inject */
    public $categoryFormControlFactory;

    /** @var CategoryRepository */
    public $categoryRepository;

    /** @var ImageRepository */
    public $imageRepository;

    /** @var ImageUploadControlFactory @inject */
    public $imageUploadControlFactory;

    /** @var GridControlFactory @inject */
    public $gridControlFactory;

    /**
     * CategoryPresenter constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryArticleRepository $categoryArticleRepository
     * @param TemplatesRepository $templatesRepository
     * @param ImageRepository $imageRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryArticleRepository $categoryArticleRepository,
        TemplatesRepository $templatesRepository,
        ImageRepository $imageRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryArticleRepository = $categoryArticleRepository;
        $this->templatesRepository = $templatesRepository;
        $this->imageRepository = $imageRepository;
    }




    /** render */
    public function renderDefault()
    {
        $this->template->categories = $this->categoryRepository->find(['status' => 'show']);
    }

    public function renderAdd()
    {

    }

    public function renderEdit($id)
    {
        $category = $this->categoryRepository->get(['id' => $id]);
        $this->template->id = $id;
        $this->template->category = $category;
        $this->template->path = IMAGES_PATH . "/categories/";
    }

    public function createComponentCategoryForm()
    {
        return $this->categoryFormControlFactory->create();
    }

    /**
     * @return ImageUploadControl
     */
    protected function createComponentImageUpload(): ImageUploadControl
    {
        $id = $this->presenter->getParameter('id');
        $category = $this->categoryRepository->get(['id' => $id]);
        $repository = $this->categoryRepository;
        $renderPath = IMAGES_PATH . "/categories/";
        $articleRelationTitle = "category_image";
        $categoryId = "category_id";
        $typeParent = "Category";
        $savingPath = SAVING_PATH . "/categories/";
        $relationRepository = $this->articleImageRepository;

        return $this->imageUploadControlFactory->create($renderPath, $repository, $category, $articleRelationTitle, $categoryId, $typeParent, $savingPath, $relationRepository, $id);

    }

    /**
     * @return mixed
     */
    protected function createComponentGrid()
    {
        $repository = $this->categoryRepository;
        $category_id = "category_id";
        $articleRelationTitle = "category_image";
        $link = "Category";

        return $this->gridControlFactory->create($repository, $category_id, $articleRelationTitle, $link);
    }

}