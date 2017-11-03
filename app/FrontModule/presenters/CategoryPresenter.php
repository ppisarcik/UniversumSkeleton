<?php

namespace App\FrontModule\Presenters;

use App\Repositories\CategoryRepository;
use App\Repositories\RelationsRepository;
use App\Repositories\TemplatesRepository;
use Tracy\Debugger;


class CategoryPresenter extends BasePresenter
{
    private $categoryRepository;

    /** @var RelationsRepository */
    private $relationsRepository;

    /** @var TemplatesRepository */
    private $templatesRepository;

    public function __construct(CategoryRepository $categoryRepository, RelationsRepository $relationsRepository, TemplatesRepository $templatesRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->templatesRepository = $templatesRepository;
    }

    public function renderShow($id)
    {
        $category = $this->categoryRepository->get(['slug' => $id]);

        $sub_category = $this->categoryRepository->getSubCategory($category);

        $getTemplate = $this->templatesRepository->get(['category_id' => $category->id]);

        $template = $getTemplate ? $getTemplate->template_name : false;

        if ($template) {
            $this->template->setFile(__DIR__ . "/templates/Category/" . $template);
        } else {
            $this->template->setFile(__DIR__ . "/templates/Category/show.latte");
        }

        $this->template->slug = $id;
        $this->template->id = $category->id;
        $this->template->category = $category;
        $this->template->sub_category = $sub_category;

    }

}