<?php
namespace App\AdminModule\Components\UserGrid;

use App\AdminModule\Components\BaseControl;
use App\Repositories\UserRepository;
use Nette\Security\User;
use Ublaboo\DataGrid\DataGrid;

interface UserGridControlFactory
{
    /**
     * @return UserGridControl
     */
    public function create();
}

class UserGridControl extends BaseControl
{
    /** @var UserRepository */
    private $userRepository;

    /** @var User */
    private $user;


    public function __construct(UserRepository $userRepository, User $user)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
    }

    public function handleDelete($id)
    {
        $this->repository->update(['id' => $id], ['deleted_at' => date('Y-m-d G:i:s')]);

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

        $grid->setDataSource($this->userRepository->find(['deleted_at' => 'null']));

        $grid->addColumnText('username', 'Username');
        $grid->addColumnText('email', 'Email');
        $grid->addColumnText('first_name', 'First name');
        $grid->addColumnText('last_name', 'Last name');
        $grid->addColumnText('role', 'Role');

        if ($this->presenter->getUser()->isInRole('administrator')) {
            $grid->addAction('delete', '', 'delete!', ['id'])
                ->setIcon('trash-o')
                ->setTitle('delete')
                ->setClass('ajax');
        }

        if ($this->user->isInRole('administrator')) {
            $grid->addAction('id', '', 'Permissions:edit')
                ->setIcon('pencil')
                ->setClass('ajax')
                ->addAttributes([
                    'data-toggle' => 'modal',
                    'data-target' => '#editModal',
                    'data-heading' => 'Edit user'
                ]);
        }

        $grid->setTemplateFile(__DIR__ . '/customGrid.latte');

        return $grid;

    }

    public function deleteAll($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        foreach ($ids as $id) {
            $this->repository->update(['id' => $id], ['deleted_at' => date('Y-m-d G:i:s')]);
        }

        $this->flashMessage('Successfully deleted from database');

        $this->presenter->redirect('this');
    }

}
