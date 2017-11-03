<?php

namespace App\FrontModule\Presenters;

use App\Components\CategoryList\CategoryListControlFactory;
use App\Components\Slider\SliderControlFactory;
use App\Components\ArticleList\ArticleListControlFactory;
use App\Components\Menu\MenuControlFactory;
use App\FrontModule\Components\Counseling\CounselingControlFactory;
use App\FrontModule\Components\OrderForm\OrderFormControlFactory;
use App\FrontModule\Components\Shops\ShopsControlFactory;
use App\Repositories\SettingsRepository;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var SliderControlFactory @inject */
    public $sliderControlFactory;

    /** @var CategoryListControlFactory @inject */
    public $listControlFactory;

    /** @var ArticleListControlFactory @inject */
    public $articleListControlFactory;

    /** @var MenuControlFactory @inject */
    public $menuControlFactory;

    /** @var OrderFormControlFactory @inject */
    public $orderFormControlFactory;

    /** @var ShopsControlFactory @inject */
    public $shopsControlFactory;

    /** @var CounselingControlFactory @inject */
    public $counselingControlFactory;

    /** @var SettingsRepository @inject */
    public $settingsRepository;

    public function beforeRender()
    {
        $this->template->settings = $this->settingsRepository->findPairs('value', 'name');
        $this->template->presenterName = $this->presenter->getName();
        $this->template->date = date('jS F Y');
    }

    public function createComponentSlider()
    {
        return $this->sliderControlFactory->create('Slider');
    }

    public function createComponentCategoryList()
    {
        return $this->listControlFactory->create('categoryList');
    }

    public function createComponentArticleList()
    {
        return $this->articleListControlFactory->create('articleList');
    }

    public function createComponentMenu()
    {
        return $this->menuControlFactory->create();
    }

    public function createComponentOrderForm()
    {
        return $this->orderFormControlFactory->create();
    }

    public function createComponentShops()
    {
        return $this->shopsControlFactory->create();
    }

    public function createComponentCounseling()
    {
        return $this->counselingControlFactory->create();
    }

}
