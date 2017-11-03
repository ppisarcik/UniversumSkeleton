<?php

namespace App\FrontModule\Presenters;

use App\Components\Gallery\GalleryControlFactory;
use App\Repositories\ArticleRepository;

class ArticlePresenter extends BasePresenter
{
    /** @var ArticleRepository */
    private $articleRepository;

    /** @var GalleryControlFactory @inject */
    public $galleryControlFactory;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function renderShow($id)
    {
        $articleSlug = $this->articleRepository->get(['slug' => $id]);
        $select = $articleSlug;

        if (!$select) {
            $this->redirect('Homepage:');
        }

        $this->template->slug = $id;
        $this->template->id = $select->id;
        $this->template->article = $select;

    }

    public function createComponentGallery()
    {
        return $this->galleryControlFactory->create();
    }
}