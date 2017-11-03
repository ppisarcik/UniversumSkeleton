<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Components\User\UserFormControlFactory;
use App\AdminModule\Components\UserGrid\UserGridControlFactory;
use App\Repositories\ImageRepository;
use App\Repositories\UserRepository;
use Nette;


class PermissionsPresenter extends BasePresenter
{

    /** @var UserFormControlFactory @inject */
    public $userFormControlFactory;

    /** @var UserRepository */
    private $userRepository;

    /** @var ImageRepository */
    public $imageRepository;

    /** @var UserGridControlFactory @inject */
    public $userGridControlFactory;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function handleDelete($id)
    {
        $this->userRepository->delete(['id' => $id]);
        if($this->isAjax()){
            $this->redrawControl('users');
        }else{
            $this->redirect('this');
        }
    }

    public function renderDefault()
    {
        $this->template->userId = $this->getUser()->id;
        $this->template->users = $this->userRepository->find();
        $this->template->administrator = $this->getUser()->isInRole('administrator');
    }

    public function renderEdit($id)
    {
        $this->template->users = $this->userRepository->find();
    }

    public function createComponentUserForm()
    {
        return $this->userFormControlFactory->create();
    }

    public function createComponentUserGrid()
    {
        return $this->userGridControlFactory->create();
    }


}
