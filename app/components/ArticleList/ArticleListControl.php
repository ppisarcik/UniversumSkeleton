<?php

namespace App\Components\ArticleList;

use App\Components\BaseControl;
use App\Components\Slider\SliderControlFactory;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;

interface ArticleListControlFactory
{
    /** @return ArticleListControl */
    public function create();
}

class ArticleListControl extends BaseControl
{
    /** @var ArticleRepository */
    private $articleRepository;

    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var RelationsRepository */
    private $relationsRepository;

    /** @var SliderControlFactory */
    private $sliderControlFactory;

    /** @var ArticleListControlFactory */
    private $articleListFactory;

    /** @var ImageRepository */
    private $imageRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        RelationsRepository $relationsRepository,
        SliderControlFactory $sliderControlFactory,
        ArticleListControlFactory $articleListControlFactory,
        ImageRepository $imageRepository
    )
    {
        $this->relationsRepository = $relationsRepository;
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->sliderControlFactory = $sliderControlFactory;
        $this->articleListFactory = $articleListControlFactory;
        $this->imageRepository = $imageRepository;
    }

    public function render($params = [])
    {

        $params += ['category_id' => null, 'template' => 'default', 'sort' => 'id ASC', 'slug' => null, 'image_id' => false];

        $template = $this->template;

        $id = [];
        $template->images = [];

        $template->slug = $params['slug'];
        $template->setFile(__DIR__ . '/' . $params['template'] . ".latte");
        $categoryId = $this->categoryRepository->get(['id' => $params['category_id']]);
        $articles = $categoryId ? $this->relationsRepository->getItemsOfRelations($categoryId, $params['sort'], 'article') : [];

        foreach ($articles as $article) {
            $id[] = $article->id;
        }

        $articleShow = $this->articleRepository->get(['slug' => $params['slug']]);
        $template->articleShow = $articleShow;


        if ($params['image_id']) {
            $template->images = $this->imageRepository->find(['id' => $params['image_id']]);
        } else if ($params['image_id'] === null) {
            $template->images = [];
        }

        /*Images path*/
        $template->path = IMAGES_PATH . "/articles/";

        $template->articles = $articles;
        $template->hasNodes = $this->relationsRepository->hasNodes($articles);
        $template->render();

    }

    public function createComponentSlider()
    {
        return $this->sliderControlFactory->create();
    }

    public function createComponentArticleList()
    {
        return $this->articleListFactory->create();
    }

}
