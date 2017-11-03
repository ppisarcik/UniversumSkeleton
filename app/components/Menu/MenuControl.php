<?php

namespace App\Components\Menu;

use App\Components\ArticleList\ArticleListControlFactory;
use App\Components\BaseControl;
use App\Components\CategoryList\CategoryListControlFactory;
use App\Repositories\CategoryRepository;
use App\Repositories\ContactsRepository;
use App\Repositories\MenuRepository;
use App\Repositories\RelationsRepository;

interface MenuControlFactory
{
    /** @return MenuControl */
    public function create();
}

class MenuControl extends BaseControl
{
    /** @var CategoryListControlFactory */
    public $categoryListControlFactory;

    /** @var ArticleListControlFactory */
    public $articleListControlFactory;

    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var MenuRepository */
    private $menuRepository;

    /** @var MenuControlFactory */
    private $menuControlFactory;

    /** @var RelationsRepository */
    private $relationsRepository;

    /** @var ContactsRepository */
    private $contactsRepository;

    public function __construct(
        CategoryListControlFactory $categoryListControlFactory,
        ArticleListControlFactory $articleListControlFactory,
        CategoryRepository $categoryRepository,
        MenuControlFactory $menuControlFactory,
        MenuRepository $menuRepository,
        RelationsRepository $relationsRepository,
        ContactsRepository $contactsRepository
    )
    {
        $this->categoryListControlFactory = $categoryListControlFactory;
        $this->articleListControlFactory = $articleListControlFactory;
        $this->categoryRepository = $categoryRepository;
        $this->menuRepository = $menuRepository;
        $this->menuControlFactory = $menuControlFactory;
        $this->relationsRepository = $relationsRepository;
        $this->contactsRepository = $contactsRepository;
    }

    public function render($params = [])
    {
        $params += ['id' => 1, 'template' => 'main', 'sort' => 'id DESC', 'slug' => null, 'parentId' => 1];

        $template = $this->template;

        $categories = $this->categoryRepository->find([], 'id ASC');
        $mainCategories = $this->categoryRepository->buildTree($categories);
        $template->mainCategories = $mainCategories;

        $template->menu = $this->menuRepository->find(['parent_id' => null], 'id ASC', 6);

        /*Get contacts from db*/
        $contacts = $this->contactsRepository->findPairs('value', 'name', [], 'id ASC');
        $template->contacts = $contacts ? $contacts : false;

        $template->setFile(__DIR__ . "/" . $params['template'] . ".latte");
        $template->render();
    }

    public function createComponentCategoryList()
    {
        return $this->categoryListControlFactory->create();
    }

    public function createComponentArticleList()
    {
        return $this->articleListControlFactory->create();
    }

    public function createComponentMenu()
    {

        return $this->menuControlFactory->create();
    }


}
