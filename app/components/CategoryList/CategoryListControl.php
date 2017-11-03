<?php

namespace App\Components\CategoryList;

use App\Components\ArticleList\ArticleListControlFactory;
use App\Components\BaseControl;
use App\Repositories\CategoryRepository;
use App\Components\Slider\SliderControlFactory;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use IPub\VisualPaginator\Components as VisualPaginator;
use Tracy\Debugger;


interface CategoryListControlFactory
{
    /** @return CategoryListControl */
    public function create();
}

class CategoryListControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var CategoryListControlFactory */
    private $categoryListFactory;

    /** @var ArticleListControlFactory */
    private $articleListFactory;

    /** @var SliderControlFactory */
    private $sliderControlFactory;

    /** @var RelationsRepository */
    private $relationsRepository;

    /** @var ImageRepository */
    private $imageRepository;

    public function __construct(
        RelationsRepository $relationsRepository,
        CategoryRepository $categoryRepository,
        CategoryListControlFactory $categoryListFactory,
        ArticleListControlFactory $articleListControlFactory,
        SliderControlFactory $sliderControlFactory,
        ImageRepository $imageRepository
    )
    {
        $this->relationsRepository = $relationsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryListFactory = $categoryListFactory;
        $this->articleListFactory = $articleListControlFactory;
        $this->sliderControlFactory = $sliderControlFactory;
        $this->imageRepository = $imageRepository;
    }

    public function render($params = [])
    {
        $template = $this->template;

        $params += ['id' => 1, 'template' => 'default', 'sort' => 'id DESC', 'slug' => null, 'image_id' => false];

        /** Visual Paginator*/
        /*$visualPaginator = $this['visualPaginator'];
        $itemList = $this->categoryRepository->find(['parent_id' => $params['id']]);
        $paginator = $visualPaginator->getPaginator();
        $paginator->itemsPerPage = 4;
        $paginator->itemCount = count($itemList);*/


        $template->setFile(__DIR__ . "/" . $params['template'] . ".latte");
        $template->id = $params['id'];
        $template->slug = $params['slug'];

        $mainCategories = $this->categoryRepository->find(['parent_id' => $params['id']], $params['sort']/*, $paginator->itemsPerPage, $paginator->offset*/);
        $subCategories = $this->categoryRepository->find(['parent_id' => $params['id']], $params['sort']);
        /*$template->images = $this->relationsRepository->getItemsPairsOfRelations('category_image', ['category_id IN (?)' => array_keys($subCategories), 'image.deleted_at' => ''], 'category_id');*/
        /* $template->images = $this->relationsRepository->getItemsPairsOfRelations('categories', ['image_id IN (?)' => array_keys($this->imageRepository->find())], 'id');
 */
        $template->images = [];

        if ($params['image_id']) {
            $template->images = $this->imageRepository->find(['id' => $params['image_id']]);
        } else if ($params['image_id'] === null) {
            $template->images = [];
        }

        $image = $this->imageRepository->find(['id' => $mainCategories]);
        $template->mainImage = $image;
        $template->producers = $this->categoryRepository->get(['id' => 9]);

        $template->mainCategories = $mainCategories;
        $template->subCategories = $subCategories;

        $categoryId = $this->categoryRepository->get(['id' => $params['id']]);
        $template->articles = !$subCategories ? $this->relationsRepository->getItemsOfRelations($categoryId, $params['sort'], 'article') : [];

        /*Images path*/
        $template->path = IMAGES_PATH . "/categories/";

        /*Get images under category*/
//        $images = $this->relationsRepository->getItemsOfRelations($categoryId, $params['sort'], 'image');
//        $template->images = $images;

        if ($subCategories && $params['template'] == 'sub/buttons') {
            $template->hasNodes = true;
        } else {
            $template->hasNodes = false;
        }

        $template->render();
    }


    public function createComponentCategoryList()
    {

        return $this->categoryListFactory->create();
    }

    public function createComponentArticleList()
    {
        return $this->articleListFactory->create();
    }

    public function createComponentSlider()
    {
        return $this->sliderControlFactory->create();
    }

    /**
     * Create items paginator
     *
     * @return VisualPaginator\Control
     */
    protected function createComponentVisualPaginator()
    {
        // Init visual paginator
        $control = new VisualPaginator\Control;
        $control->setTemplateFile('bootstrap.latte');
        return $control;
    }

}
