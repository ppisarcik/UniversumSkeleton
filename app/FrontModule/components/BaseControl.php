<?php

namespace App\FrontModule\Components;

use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Control;

abstract class BaseControl extends Control
{
    /** @var CategoryRepository */
    protected $categoryRepository;

    /** @var RelationsRepository */
    protected $relationsRepository;

    /** @var OrderRepository  */
    protected $orderRepository;

    public function __construct(CategoryRepository $categoryRepository, RelationsRepository $relationsRepository, OrderRepository $orderRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->orderRepository = $orderRepository;
    }

}