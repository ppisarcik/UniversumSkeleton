<?php
namespace App\AdminModule\Components\Contact;

use App\AdminModule\Components\BaseControl;
use App\Repositories\ContactsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Nette\Utils\Html;
use Tracy\Debugger;

interface ContactFormControlFactory
{
    /** @return ContactFormControl */
    public function create();

}

class ContactFormControl extends BaseControl
{
    /** @var ContactsRepository */
    private $contactsRepository;

    /** @var ImageRepository */
    private $imageRepository;

    /** @var RelationsRepository */
    private $relationRepository;

    /** @var $children */
    private $children;

    public function __construct(ContactsRepository $contactsRepository, ImageRepository $imageRepository, RelationsRepository $relationsRepository)
    {
        parent::__construct();
        $this->contactsRepository = $contactsRepository;
        $this->imageRepository = $imageRepository;
        $this->relationRepository = $relationsRepository;
    }

    public function render()
    {
        $id = $this->presenter->getParameter('id');
        $contacts = $this->contactsRepository->find(['deleted_at' => null]);
        $this->children = $this->contactsRepository->buildTree($contacts, $id);

        usort($this->children, function($a, $b) {
            $retval = $a['sort'] <=> $b['sort'];
            return $retval;
        });
        $template = $this->template;
        $template->contact = $this->contactsRepository->get(['id' => $id, 'deleted_at' => null]);
        $template->children = $this->children;
        $template->id = $id;
        $template->setFile(__DIR__ . '/ContactForm.latte');
        $template->render();
    }

    /**
     * Component category form
     *
     * @return Form
     */
    protected function createComponentContactForm()
    {
        $id = $this->presenter->getParameter('id');
        $newElement = $this->presenter->getParameter('newElement');
        $contact = $this->contactsRepository->get(['id' => $id, 'deleted_at' => null]);
        $contacts = $this->contactsRepository->find(['deleted_at' => null], 'sort ASC');
        $this->children = $this->contactsRepository->buildTree($contacts, $id);
        $form = new Form;

        $form->addText($contact->name, '');
        $form->setDefaults([$contact['name'] => $contact['value']]);

        usort($this->children, function($a, $b) {
            $retval = $a['sort'] <=> $b['sort'];
            return $retval;
        });

        foreach ($this->children as $key => $value) {
            $form->addText($value['name'], $value['title']);
            $form->setDefaults([$value['name'] => $value['value']]);

            if (substr($key, 1, 7) == 'element') {
                $form->addText($key, 'test');
            }

//             Html::el('a', ['class' => 'ajax'])->href('?id_deleted=' . $key . '&do=deleteContact')->setText('Delete');

        }

        $form->addSubmit('send', 'Save');

        $form->onSuccess[] = [$this, 'onSubmit'];

        return $form;
    }

    public function onSubmit(UI\Form $form, $values)
    {
        $id = $this->presenter->getParameter('id');

        foreach ($values as $key => $value) {

            if (!substr($key, 1, 4) == 'shop') {
                $this->contactsRepository->update(['name' => $key], ['value' => $value, 'parent_id' => $id]);
            } else {
                $this->contactsRepository->update(['name' => $key], ['value' => $value]);
            }
        }
        if($this->presenter->isAjax()) {
            $this->redrawControl('contact');
        } else {
            $this->redirect('this');
        }
    }

    public function moveImage($image, $path)
    {
        $save = SAVING_PATH . '/' . $path . '/' . $image->name;
        $image->move($save);
    }
}
