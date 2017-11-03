<?php

namespace App\Components\Slider;

use App\Components\BaseControl;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use Tracy\Debugger;

interface SliderControlFactory
{
    /** @return SliderControl */
    public function create();
}

class SliderControl extends BaseControl
{

    private $imageRepository;
    private $categoryRepository;
    private $articleRepository;
    private $relationsRepository;

    public function __construct(
        ImageRepository $imageRepository,
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        RelationsRepository $relationsRepository
    )
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->relationsRepository = $relationsRepository;
    }

    /**
     * @param array $params
     */
    public function render($params = [])
    {
        $params += ['images' => null, 'id' => null, 'slug' => null, 'template' => 'default', 'sort' => 'id DESC', 'path' => null, 'articleId' => null];

        $template = $this->template;

        $categoryId = $params['id'];

        $categorySlug = $this->categoryRepository->get(['slug' => $params['slug']]);
        $articleSlug = $this->articleRepository->get(['slug' => $params['slug']]);

        $category = $categorySlug ? $categorySlug : $articleSlug;

        $template->setFile(__DIR__ . '/' . $params['template'] . '.latte');

        $template->path = IMAGES_PATH . "/" . $params['path'] . "/";

        $template->category = $category;
        $template->mainImage = false;
        if ($categoryId) {

            $category = $this->categoryRepository->get(['id' => $params['id']]);

            if ($category) {

                $images = $this->relationsRepository->getItemsOfRelations($category, $params['sort'], 'image');
                $image = $this->imageRepository->get(['id' => $category['image_id']]);
                $template->mainImage = $image;
                $template->images = $images;
            }

        } else {

            $article = $this->articleRepository->get(['id' => $params['articleId']]);

            if ($article) {
                $images = $this->relationsRepository->getItemsOfRelations($article, $params['sort'], 'image');

                $template->images = $images;
            }
        }

        $template->render();

    }

}
