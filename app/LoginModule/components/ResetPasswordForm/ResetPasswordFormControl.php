<?php
namespace App\LoginModule\Components\ResetPasswordForm;

use App\LoginModule\Components\BaseControl;
use App\Repositories\UserRepository;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Nette\Security\User;
use Tracy\Debugger;

interface ResetPasswordFormControlFactory
{
    /** @return ResetPasswordFormControl*/
    public function create();
}

class ResetPasswordFormControl extends BaseControl
{
    /** @var UserRepository  */
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function createComponentResetPasswordForm()
    {
        $form = new Form;

        $form->addPassword('password', 'Password:')
            ->setRequired('Password required!')
            ->addRule(Form::MIN_LENGTH, 'Password is too short, minimal %d', 5);
        $form->addPassword('repeat_password', 'Repeat password:')
            ->setRequired('Password required!')
            ->addRule(Form::EQUAL, 'Passwords do not match', $form['password']);

        $form->addSubmit('submit', 'Send Password');
        $form->addHidden('token', $this->presenter->getParameter('token'));

        $form->onSuccess[] = [$this, 'onSubmit'];

        return $form;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/ResetPasswordForm.latte');
        $template->render();
    }

    public function onSubmit(Form $form, $values)
    {
        $password = Passwords::hash($values['password']);
        $update = $this->userRepository->update(['token' => $values->token], ['password' => $password]);

        if ($update) {
            $this->presenter->flashMessage('Password changed', 'success');
            $this->presenter->redirect('Sign:in');
        }
    }
}
