<?php
namespace App\LoginModule\Components\ForgotPasswordForm;

use App\LoginModule\Components\BaseControl;
use App\Repositories\UserRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Tracy\Debugger;
use Nette\Mail;
use Nette\Utils\Random;

interface ForgotPasswordControlFactory
{
    /** @return ForgotPasswordControl */
    public function create();
}

class ForgotPasswordControl extends BaseControl
{
    private $userRepository;
    private $mailer;

    public function __construct(UserRepository $userRepository, Mail\IMailer $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }


    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/ForgotPassword.latte');
        $template->render();
    }


    protected function createComponentForgotPasswordForm()
    {
        $form = new Form;

        $form->addEmail('email', 'Email:')
             ->setRequired('Enter email!');

        $form->addSubmit('submit', 'Reset password');

        $form->onSuccess[] = [$this, 'onSubmit'];

        return $form;
    }

    public function onSubmit(Form $form, $values)
    {

        $verification = $this->userRepository->get(['email' => $values->email]);

        if ($verification) {
            $token = Random::generate('50');
            $this->userRepository->update(['id' => $verification->id], ['token' => $token]);
            $this->sendMail($verification, $token);
        }

        $this->presenter->redirect(':Login:ForgotPassword:');
        $this->presenter->flashMessage('Success');
    }

    private function sendMail($data, $token)
    {
        $mail = new Mail\Message();
        $mail->setFrom('reset@password.com', 'Server');
        $mail->addTo($data->email);
        $mail->setSubject('Reset password');
        $mail->setHtmlBody('Hello ' . $data->first_name . ',<br>Your request for reset password. <a href="http://podlahyadvere.localhost/reset-password/?email=' . $data->email . '&token=' . $token . '">Click here for reset password</a>');

        $this->mailer->send($mail);
        return $mail;
    }
}
