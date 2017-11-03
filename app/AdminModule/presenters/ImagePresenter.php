<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Components\ImageForm\ImageFormControlFactory;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use Tracy\Debugger;
use Exception;
class ImagePresenter extends BasePresenter
{
    /** @persistent */
    public $idParent;

    /** @persistent */
    public $typeParent;

    /** @persistent */
    public $renderPath;

    /** @persistent */
    public $relationId;


    /** @var CategoryRepository */
    public $categoryRepository;

    /**@var ArticleRepository */
    public $articleRepository;

    /** @var OrderRepository */
    private $orderRepository;

    /** @var ImageFormControlFactory @inject */
    public $imageFormControlFactory;

    public function __construct
    (
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        OrderRepository $orderRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->orderRepository = $orderRepository;
    }

    public function renderEdit($id)
    {
        $this->imageRepository->get(['id' => $id]);

        $idParent = $this->presenter->getParameter('idParent');
        $repository = $this->presenter->getParameter('typeParent');

        try {

            $item = $this->getRepository($repository)->get(['id' => $idParent]);
            if (!$item) {
                throw new Exception();
            }

        } catch (Exception $e) {

            $this->presenter->error('Zaznam neexistuje');
        }





        /*$categoryImage = $this->categoryImageRepository->get(['image_id' => $image]);
        $categoryId = $categoryImage->category_id;

        $this->template->id = $id;
        $this->template->image = $image;
        $this->template->path = IMAGES_PATH . "/categories/";
        $this->template->categoryId = $categoryId;*/
    }

    /**
     * @return \App\AdminModule\Components\ImageForm\ImageFormControl
     */
    public function createComponentImageForm()
    {
        $repository = null;
        $parentId = $this->presenter->getParameter('idParent');
        $typeParent = $this->presenter->getParameter('typeParent');
        $renderPath = $this->presenter->getParameter('renderPath');

        if ($typeParent) {
            $repository = $this->getRepository($typeParent);
        }

        $relationName = $this->presenter->getParameter('relationId');


        $control = $this->imageFormControlFactory->create($parentId, $typeParent, $renderPath, $repository, $relationName);

        return $control;
    }

}
