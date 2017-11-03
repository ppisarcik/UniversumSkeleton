<?php

namespace App\Components\Gallery;


use App\Components\BaseControl;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\RelationsRepository;

interface GalleryControlFactory
{
    /** @return GalleryControl */
    public function create();
}

class GalleryControl extends BaseControl
{

    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var ArticleRepository */
    private $articleRepository;

    /** @var RelationsRepository */
    private $relationsRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        RelationsRepository $relationsRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->relationsRepository = $relationsRepository;
    }

    public function render($params = [])
    {
        $params += ['id' => 1, 'template' => 'default', 'sort' => 'id DESC', 'slug' => null];
        $template = $this->template;

        $categorySlug = $this->categoryRepository->get(['slug' => $params['slug']]);
        $articleSlug = $this->articleRepository->get(['slug' => $params['slug']]);

        $row = $categorySlug ? $categorySlug : $articleSlug;

        $images = $this->relationsRepository->getItemsOfRelations($row, 'id DESC', 'image');

        $type = $categorySlug ? 'categories' : 'articles';
        $path = IMAGES_PATH . "/" . $type . "/";

        $template->path = $path;
        $template->images = $images;

        $template->setFile(__DIR__ . "/" . $params['template'] . ".latte");
        $template->render();
    }

}
