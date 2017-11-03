<?php

namespace App\AdminModule\Presenters;


use App\Repositories\ArticleImageRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryArticleRepository;
use App\Repositories\CategoryImageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RelationsRepository;
use App\Repositories\TemplatesRepository;
use App\Repositories\UserRepository;
use Nette;
use Kdyby\Translation\Translator;
use Tracy\Debugger;
use App\Plugins\FileUploader;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\DI\Container @inject */
    public $context;

    /** @persistent */
    public $locale;

    /** @var Translator @inject */
    public $translator;

    /** @var ImageRepository @inject */
    public $imageRepository;

    /** @var OrderRepository */
    private $orderRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var CategoryRepository @inject */
    public $categoryRepository;

    /** @var ArticleRepository @inject */
    public $articleRepository;

    /** @var CategoryImageRepository  @inject */
    public $categoryImageRepository;

    /** @var ArticleImageRepository @inject */
    public $articleImageRepository;

    /** @var CategoryArticleRepository @inject */
    public $categoryArticleRepository;

    /** @var TemplatesRepository @inject */
    public $templatesRepository;

    /** @var RelationsRepository @inject */
    public $relationsRepository;

    public function __construct(
        ImageRepository $imageRepository,
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        CategoryImageRepository $categoryImageRepository,
        ArticleImageRepository $articleImageRepository
    )
    {
        parent::__construct();
        $this->imageRepository = $imageRepository;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryImageRepository = $categoryImageRepository;
        $this->articleImageRepository = $articleImageRepository;

    }

    /**
     *
     */
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isInRole('user') && !$this->getUser()->isInRole('administrator')) {
            $this->redirect(':Login:Sign:in');
        }
    }

    public function handleDeleteImage()
    {

        $imageId = $this->getParameter('imageId');
        $itemId = $this->getParameter('id');
        $repository = $this->getParameter('repository');

        if ($repository === "category") {
            $this->categoryRepository->update(['id' => $itemId], ['image_id' => null]);
            $this->categoryImageRepository->delete(['image_id' => $imageId]);
        }

        if ($repository === "article") {
            $this->articleRepository->update(['id' => $itemId], ['image_id' => null]);
            $this->articleImageRepository->delete(['image_id' => $imageId]);
        }


        $this->imageRepository->delete(['id' => $imageId]);

        $this->flashMessage('Successfully deleted from database');
        if ($this->isAjax()) {
            $this->redrawControl('images');
            $this->redrawControl('flash');
        } else {
            $this->redirect('Category:default');
        }
    }

    /**
     * @param null $type
     * Add new type
     * @param array $params
     */
    public function handleAddNew($type = null, array $params = [])
    {
        try {
            $id = $this->getRepository($type)->create($params);
        } catch (\Exception $exception) {
            $exception->getMessage();
            $id = null;
        }

        if ($this->isAjax()) {
            $this->redirect($type . ':edit', $id);
        } else {
            $this->redirect($type . ':edit', $id);
        }
    }

    public function handleDelete($id)
    {
        $categoryArticle = $this->categoryArticleRepository->find(['category_id' => $id]);
        $templates = $this->templatesRepository->find(['category_id' => $id]);

        if ($categoryArticle) {

            foreach ($categoryArticle as $category) {
                $this->categoryArticleRepository->delete(['id' => $category->id]);
            }

        } elseif ($templates) {
            $this->templatesRepository->delete(['category_id' => $id]);

        } else {
            $this->categoryRepository->update(['parent_id' => $id], ['parent_id' => null]);
        }

        $this->categoryRepository->delete(['id' => $id]);

        if ($this->isAjax()) {
            $this->redrawControl('category');
        } else {
            $this->redirect('this');
        }
    }

    public function handleUpdate($image_id, $category_id)
    {

        $this->categoryRepository->update(['id' => $category_id], ['image_id' => $image_id]);
        $this->flashMessage('success');
        if ($this->isAjax()) {
            $this->redrawControl('images');
            $this->flashMessage('success');
        } else {
            $this->redirect('this');
        }
    }

    public function handleDeleteMultiple()
    {

        $id = $this->getParameter('ids');

        if (!is_array($id)) {
            $id = [$id];
        }

        $categoryArticle = $this->categoryArticleRepository->find(['category_id IN (?)' => $id]);

        $templates = $this->templatesRepository->find(['category_id IN (?)' => $id]);

        if ($categoryArticle) {
            foreach ($categoryArticle as $category) {
                $this->categoryArticleRepository->delete(['category_id IN (?)' => $category->id]);
            }

        }
        if ($templates) {
            $this->templatesRepository->delete(['category_id IN (?)' => $id]);

        }

        $this->categoryRepository->update(['parent_id IN (?)' => $id], ['parent_id' => null]);

        $this->categoryRepository->delete(['id IN (?)' => $id]);

        $this->flashMessage('Successfully deleted from database');

        if ($this->isAjax()) {
            $this->redrawControl('category');
            $this->redrawControl('flash');

        } else {
            $this->redirect('this');

        }

    }

    public function beforeRender()
    {
        $this->template->username = $this->getUser()->getIdentity()->username;
        $imageId = $this->getUser()->getIdentity()->image;

        $this->template->usersPath = IMAGES_PATH . "/users/";

        if ($imageId) {
            $image = $this->imageRepository->get(['id' => $imageId]);
            $this->template->profileImage = $image;

        } else {
            $this->template->profileImage = false;
        }

        $this->template->role = $this->getUser()->isInRole('administrator');
        $this->template->presenterName = $this->presenter->getName();
        $this->template->date = date('jS F Y');
    }

    protected function getRepository(string $name)
    {
        if(!isset($this->context->parameters['repositories'][$name])) {
            throw new \Exception("Repozitar neexistuje.");
        }

        return $this->context->getService($this->context->parameters['repositories'][$name]);

    }
}
