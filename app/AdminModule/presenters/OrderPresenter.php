<?php

namespace App\AdminModule\Presenters;

use App\Repositories\OrderRepository;
use App\AdminModule\Components\OrderGrid;

class OrderPresenter extends BasePresenter
{

    /** @var OrderRepository */
    private $orderRepository;

    /** @var OrderGrid\OrderGridControlFactory @inject */
    public $orderGridControlFactory;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handleUpdateOrder($id)
    {

        $this->orderRepository->update(['id' => $id], ['status' => 'completed', 'updated_at' => date('Y-m-d G:i:s')]);

        if($this->isAjax()){
            $this->redrawControl('order');
        }else{
            $this->redirect('this');
        }
    }

    public function renderDefault()
    {
        $this->template->orders = $this->orderRepository->find(['status' => 'waiting']);
    }

    public function renderHistory()
    {
        $this->template->orders = $this->orderRepository->find(['status' => 'completed']);
    }


    protected function createComponentOrderGrid()
    {
        return $this->orderGridControlFactory->create();
    }
}
