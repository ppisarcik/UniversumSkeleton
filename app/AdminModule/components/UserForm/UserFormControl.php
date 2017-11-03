<?php


namespace App\AdminModule\Components\User;

use App\AdminModule\Components\BaseControl;
use App\Repositories\ImageRepository;
use App\Repositories\UserRepository;
use Nette\Application\UI\Form;
use App\Security\UserAuthenticator;
use Nette\Neon\Exception;
use Nette\Security\User;
use Tracy\Debugger;
use Nette\Security\Identity;
use Nette\Security;

interface UserFormControlFactory
{
    /** @return UserFormControl */
    public function create();
}

class UserFormControl extends BaseControl
{
    /** @var UserRepository*/
    private $userRepository;

    /** @var ImageRepository*/
    private $imageRepository;

    /** @var UserAuthenticator*/
    private $userAuthenitactor;

    /** @var User */
    private $user;

    /** @var Identity  @inject*/
    public $identity;

    public function __construct(
        UserRepository $userRepository,
        ImageRepository $imageRepository,
        UserAuthenticator $userAuthenticator,
        User $user
    )
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->userAuthenitactor = $userAuthenticator;
        $this->user = $user;
    }

    public function render()
    {
        $template = $this->template;
        $template->administrator = $this->user->isInRole('administrator');
        $id = $this->presenter->getParameter('id');
        $getUser = $this->userRepository->get(['id' => $id]);
        $getImage = null;
        if (!empty($id)) {
            $getImage = $getUser->image;
            $template->path = IMAGES_PATH . "/users/";

        }
        if (!empty($getImage)) {
            $template->image = $this->imageRepository->get(['id' => $getImage]);
        } else {
            $template->image = null;
        }
        $template->setFile(__DIR__ . '/UserForm.latte');
        $template->render();
    }

    /**
     * Component category form
     *
     * @return Form
     */
    protected function createComponentUserForm()
    {
        $id = $this->presenter->getParameter('id');
        $getUser = $this->userRepository->get(['id' => $id]);

        $form = new Form;
        $form->addUpload('image', 'Pridať obrázok:')
            ->setRequired(FALSE)
            ->addRule(Form::IMAGE, 'Obrazok musí být JPEG, PNG nebo GIF.')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je %d kB.', 6000 * 1024);

        $form->addText('username', 'Username:')
            ->setRequired('Username required!');
        if (!$id) {
            $form->addPassword('password', 'Password:')
                ->setRequired('Password required!')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaky', 5);
            $form->addPassword('repeat_password', 'Repeat password:')
                ->setRequired('Password required!')
                ->addRule(Form::EQUAL, 'Hesla sa neshoduju', $form['password']);
        } else {
            $form->addPassword('password', 'Password:')
                ->setRequired(FALSE)
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaky', 5);
            $form->addPassword('repeat_password', 'Repeat password:')
                ->setRequired(FALSE)
                ->addRule(Form::EQUAL, 'Hesla sa neshoduju', $form['password']);
        }
        $form->addEmail('email', 'Email:')
            ->setRequired('Email required!');

        if ($this->user->isInRole('administrator')) {
            $form->addSelect('role', 'Role:')
                ->setItems(['administrator', 'user'], FALSE);
        } else {
            $form->addHidden('role');
        }

        $form->addText('first_name', 'First name:')
            ->setRequired('First name required!');
        $form->addText('last_name', 'Last name:')
            ->setRequired('Last name required');
        $form->setDefaults([
            'username' => $getUser['username'],
            'email' => $getUser['email'],
            'role' => $getUser['role'],
            'first_name' => $getUser['first_name'],
            'last_name' => $getUser['last_name'],
        ]);
        $form->addSubmit('send', 'Save changes');
        $form->onSuccess[] = [$this, 'onSubmit'];
        return $form;
    }

    /**
     * @param $form
     * @param $values
     */
    public function onSubmit($form, $values)
    {
        $image = $values->image;

        $path = 'users';

        $user = [
            'username' => $values['username'],
            'email' => $values['email'],
            'role' => $values['role'],
            'first_name' => $values['first_name'],
            'last_name' => $values['last_name']
        ];


        $id = $this->presenter->getParameter('id');

        if ($id){
            if ($image->name != null){
                $imageId = $this->imageRepository->uploadSingle($image, 'adfas', $path);
                $this->userRepository->update(['id' => $id], ['image' => $imageId]);
            }

            if (!$values['password'] === "") {
                $user['password'] = Security\Passwords::hash($values['password']);
            }
            $this->userRepository->update(['id' => $id], $user);
            $this->userRepository->update(['id' => $id], ['updated_at' => date('Y-m-d G:i:s')]);


        } else{
            $user['password'] =  Security\Passwords::hash($values['password']);
            $value = $this->userRepository->create($user);
        }


        $this->presenter->flashMessage("Uložené v databáze");
        $this->reload();
        $this->presenter->redirect('Permissions:default');
    }

    private function reload() {
        if ($this->user->isLoggedIn()) {
            $id = $this->user->getId();
            $user = $this->userRepository->get(['id' => $id]);
            if (!$user) {
                // pro případ, že by byl uživatel náhodou už smazaný
                $this->user->logout(TRUE);
                return;
            }
            $identity =  new Identity($user->id, $user->role, [
                'username' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'image' => $user->image
            ]);
            $this->user->getStorage()->setIdentity($identity);
        }
    }
}