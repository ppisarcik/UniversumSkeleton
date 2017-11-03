<?php
namespace App\AdminModule\Components\OrderGrid;

use App\AdminModule\Components\BaseControl;
use App\Repositories\OrderRepository;
use Tracy\Debugger;
use Ublaboo\DataGrid\DataGrid;

interface OrderGridControlFactory
{
    /**
     * @return GridControl
     */
    public function create();
}

class GridControl extends BaseControl
{
    /** @var OrderRepository */
    private $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/grid.latte');
        $template->render();
    }

    /**
     * @param $name
     * @return DataGrid
     */
    public function createComponentGrid($name)
    {
        $grid = new DataGrid($this, $name);

        $grid->setDataSource($this->orderRepository->find(['deleted_at' => 'null']));

        $grid->addColumnText('name', 'Name')
            ->setSortable()
            ->setFilterText(['name']);

        $grid->addColumnText('email', 'Email')
            ->setSortable()
            ->setFilterText(['email']);

        $grid->addColumnText('phone', 'Phone')
            ->setSortable()
            ->setFilterText(['phone']);

        $grid->addColumnText('city', 'City')
            ->setSortable()
            ->setFilterText(['city']);

        $grid->addColumnText('message', 'Message')
            ->setSortable()
            ->setFilterText(['message']);

        $grid->addColumnText('doors', 'Doors')
            ->setSortable();

        $grid->addColumnText('doors_quantity', 'Doors Quantity')
            ->setSortable();

        $grid->addColumnText('floors', 'Floors')
            ->setSortable();

        $grid->addColumnText('floors_quantity', 'Floors Quantity')
            ->setSortable();

        $grid->addColumnStatus('status', 'Status')
            ->setSortable()
            ->addOption('1', 'Completed')
            ->setClass('btn-success')
            ->endOption()
            ->addOption('2', 'Canceled')
            ->setClass('btn-primary')
            ->endOption()
            ->addOption('0', 'Waiting')
            ->setClass('btn-danger')
            ->endOption()

            ->onChange[] = [$this, 'changeStatus'];

        $grid->addFilterSelect('status', 'Status:', [0 => 'Waiting', 2 => 'Canceled', 1 => 'Completed', '' => 'All']);
        $grid->setRememberState(FALSE);
        $grid->setDefaultFilter(['status' => 0]);


        $grid->setItemsPerPageList([10]);


        $grid->setTemplateFile(__DIR__ . '/customGrid.latte');

        return $grid;

    }

    /**
     * @param $id
     * @param $status
     * @return int
     */
    public function changeStatus($id, $status)
    {
        return $this->orderRepository->update(['id' => $id], ['status' => $status]);
    }


}
