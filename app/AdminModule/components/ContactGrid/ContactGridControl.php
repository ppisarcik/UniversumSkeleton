<?php
namespace App\AdminModule\Components\ContactGrid;

use App\AdminModule\Components\BaseControl;
use App\Repositories\ContactsRepository;
use App\Repositories\UserRepository;
use Tracy\Debugger;
use Ublaboo\DataGrid\DataGrid;

interface ContactGridControlFactory
{
    /**
     * @return ContactGridControl
     */
    public function create();
}

class ContactGridControl extends BaseControl
{
    /** @var ContactsRepository */
    private $contactRepository;

    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactRepository = $contactsRepository;
    }

    public function handleDelete($id)
    {

        $this->contactRepository->update(['id' => $id], ['deleted_at' => date('Y-m-d G:i:s')]);

        if ($this->presenter->isAjax()) {
            $this->presenter->redrawControl('flashes');
            $this['grid']->reload();
        } else {
            $this->presenter->redirect('this');
        }
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

        $grid->setDataSource($this->contactRepository->find(['parent_id' => null, 'deleted_at' => null]));

//        $grid->setTreeView([$this, 'getChildren'], [$this, 'hasChildren']);

        $grid->addColumnText('value', 'Title')
            ->setEditableCallback([$this, 'quickEdit']);

        $grid->addAction('id', '', 'Contact:edit')
            ->setIcon('pencil');

        $grid->setTemplateFile(__DIR__ . '/customGrid.latte');
        $grid->addAction('delete', '', 'delete!', ['id'])
            ->setIcon('trash-o')
            ->setTitle('Delete')
            ->setClass('ajax')
            ->setConfirm('Do you really want to delete row %s?', 'title');

        /*$grid->setTemplateFile(__DIR__ . '/customGrid.latte');*/

        return $grid;

    }

    public function getChildren($parentId)
    {
       return $this->contactRepository->find(['parent_id' => $parentId]);
    }

    public function hasChildren($element)
    {
       return $this->contactRepository->get(['parent_id' => $element->id]);
    }

    public function quickEdit($id, $value)
    {
        $this->contactRepository->update(['id' => $id], ['title' => $value]);
    }

}
