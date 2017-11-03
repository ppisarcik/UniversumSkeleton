<?php

namespace App\LoginModule\Presenters;

use App\Repositories\UserRepository;
use Nette;
use App\LoginModule\Components\ForgotPasswordForm\ForgotPasswordControlFactory;
use App\Components\SignInForm\SignInFormControlFactory;
use Tracy\Debugger;


class SignPresenter extends Nette\Application\UI\Presenter
{

    /** @var ForgotPasswordControlFactory @inject */
    public $forgotPasswordControlFactory;

    /** @var SignInFormControlFactory @inject */
    public $signInFormControlFactory;

    /** @var UserRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function actionOut()
    {
        $this->getUser()->logout();
        $this->presenter->flashMessage('Odhlášení bylo úspěšné.', 'success');
        $this->redirect(':Login:Sign:in');
    }

    public function renderForgotPassword()
    {

    }

    public function renderIn()
    {

    }

    protected function createComponentSignInForm()
    {
        return $this->signInFormControlFactory->create();
    }

    protected function createComponentForgotPasswordForm()
    {
        return $this->forgotPasswordControlFactory->create();
    }

}