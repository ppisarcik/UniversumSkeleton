<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\Menu\MenuFormControlFactory;

class MenuPresenter extends BasePresenter
{
    /** @var MenuFormControlFactory @inject */
    public $menuFormControlFactory;

    public function renderDefault()
    {

    }

    public function createComponentMenuForm()
    {
        return $this->menuFormControlFactory->create();
    }

}
