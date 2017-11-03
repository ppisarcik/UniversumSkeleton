<?php

namespace App\LoginModule\Presenters;

use App\LoginModule\Components\ResetPasswordForm\ResetPasswordFormControlFactory;
use App\Repositories\UserRepository;
use Nette;
use Tracy\Debugger;

class ForgotPasswordPresenter extends Nette\Application\UI\Presenter
{
    /** @persistent */
    public $email;

    /** @persistent */
    public $token;

    private $userRepository;

    /** @var ResetPasswordFormControlFactory @inject */
    public $resetPasswordFormFactory;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function actionDefault()
    {
        $user = $this->userRepository->get(['email' => $this->email]);

        if (!$user || $this->token != $user->token) {
            $this->presenter->redirect('Sign:in');
        }

    }

    public function createComponentResetPasswordForm()
    {
        return $this->resetPasswordFormFactory->create();
    }
}