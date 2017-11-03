<?php

namespace App\Components\SignInForm;

use App\Components\BaseControl;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Tracy\Debugger;

interface SignInFormControlFactory
{
    /** @return SignInFormControl */
    public function create();
}

/**
 * Class SignInFormControl
 *
 * @package App\Components\SignInForm
 */
class SignInFormControl extends BaseControl
{

    /** {@inheritdoc} */
    public function render()
    {
        $this->template->setFile(__DIR__ . '/default.latte');

        $this->template->render();
    }


    /**
     * Form success
     *
     * @param Form $form form
     * @param array $values values
     */
    public function onSuccess(Form $form, $values)
    {
        if ($values->remember) {
            $this->presenter->getUser()->setExpiration('14 days', FALSE);

        } else {
            $this->presenter->getUser()->setExpiration('30 minutes', TRUE);

        }

        try {
            $this->presenter->getUser()->login($values->username, $values->password);

            $this->presenter->redirect(':Admin:Homepage:default');

        } catch (AuthenticationException $e) {
            $this->presenter->flashMessage('Wrong password or username!', 'danger');
        }


    }


    /**
     * Create form component
     *
     * @return Form
     */
    protected function createComponentForm(): Form
    {
        $form = new Form;

        $form->addText('username', 'Username')
            ->setAttribute('placeholder', 'Username')
            ->setRequired('Enter username');

        $form->addPassword('password', 'Password')
            ->setAttribute('placeholder', 'Password')
            ->setRequired('Enter password');

        $form->addCheckbox('remember', 'Keep me');

        $form->addSubmit('submit', 'Sign In');

        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

}
