<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Components\Contact\ContactFormControlFactory;
use App\AdminModule\Components\ContactGrid\ContactGridControlFactory;
use App\AdminModule\Components\ImageUpload\ImageUploadControlFactory;
use App\Repositories\ContactsRepository;
use Nette\Application\UI\Form;
use Tracy\Debugger;
use App\Utils\GenerateString;


class ContactPresenter extends BasePresenter
{
    /** @var ContactFormControlFactory @inject */
    public $contactFormControlFactory;

    /** @var ContactGridControlFactory @inject */
    public $contactGridControlFactory;

    /** @var ImageUploadControlFactory @inject */
    public $imageUploadControlFactory;

    /** @var ContactsRepository */
    public $contactsRepository;

    /** @persistent */
    public $newElement;

    /** @persistent */
    public $parentId;

    /** @var GenerateString */
    private $generateString;

    /**
     * ContactPresenter constructor.
     * @param ContactsRepository $contactsRepository
     */
    public function __construct(ContactsRepository $contactsRepository, GenerateString $generateString)
    {
        $this->contactsRepository = $contactsRepository;
        $this->generateString = $generateString;
    }

    public function renderDefault()
    {
        $this->template->contacts = $this->contactsRepository->findPairs('value', 'name');
        $this->template->contactPath = IMAGES_PATH . "/contacts/";
    }

    public function renderEdit($id)
    {
        $this->contactsRepository->get(['id' => $id]);
    }

    public function renderElement()
    {

    }

    public function handleAddNewContact($type = null)
    {
        $id = $this->contactsRepository->create([
            'name' => 'shop' . date("YmdHis"),
            'title' => 'Predajna',
            'value' => null
        ]);

        $this->contactsRepository->create([
            'name' => 'number' . date("YmdHis"),
            'title' => 'Telefón',
            'value' => null,
            'parent_id' => $id
        ]);

        if ($this->isAjax()) {
            $this->redirect($type . ':edit', $id);
        } else {
            $this->redirect($type . ':edit', $id);
        }
    }

    public function handleAddNewElement()
    {
        $id = $this->getParameter('id');

        $this->contactsRepository->create([
            'name' => 'element'. date("YmdHis"),
            'parent_id' => $id
        ]);

        if ($this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->redirect('this');
        }
    }

    public function handleReorder()
    {
        $data = $this->presenter->getParameter('data');

        foreach ($data as $value) {
            $this->contactsRepository->update(['id' => $value['id']], ['sort' => $value['sort']]);
        }
    }

    public function handleDeleteContact()
    {
        $id = $this->presenter->getParameter('id_deleted');
        $idParent = $this->presenter->getParameter('id');

        $this->contactsRepository->update(['id' => $id], ['deleted_at' =>  date('Y-m-d G:i:s')]);

        if ($this->isAjax()) {
            $this->redrawControl('contact');
        } else {
            $this->redirect('Contact:edit', $idParent);
        }
    }

    public function createComponentContactForm()
    {
        return $this->contactFormControlFactory->create();
    }

    public function createComponentContactGrid()
    {
        return $this->contactGridControlFactory->create();
    }


    protected function createComponentImageUpload()
    {
        $id = $this->presenter->getParameter('id');
        $contact = $this->contactsRepository->get(['id' => $id]);
        $repository = $this->contactsRepository;
        $renderPath = IMAGES_PATH . "/contacts/";
        $contactRelationTitle = "contact_image";
        $contactId = "contact_id";
        $typeParent = "Contact";
        $savingPath = SAVING_PATH . "/contacts/";

        return $this->imageUploadControlFactory->create(
            $renderPath,
            $repository,
            $contact,
            $contactRelationTitle,
            $contactId,
            $typeParent,
            $savingPath,
            $relationRepositoryTable = null,
            $id
        );

    }

    /**
     * @return Form
     */
    protected function createComponentModalContactForm(): Form
    {
        $form = new Form;

        $form->addText('shop', 'Title')
            ->setRequired(TRUE);
        $form->addSubmit('submit', 'Send');
        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(Form $form, $values)
    {
        $generator = $this->generateString->generateRandomString(5);
        $id = $this->contactsRepository->create([
            'name' => 'shop' . $generator .date("YmdHis"),
            'title' => 'Shop: ' ,
            'value' => $values->shop
        ]);

        $this->contactsRepository->create([
            'name' => 'number' . $generator .date("YmdHis"),
            'title' => 'Number: ',
            'value' => null,
            'parent_id' => $id,
            'sort' => 1
        ]);

        $this->contactsRepository->create([
            'name' => 'adress' . $generator .date("YmdHis"),
            'title' => 'Adress: ',
            'value' => null,
            'parent_id' => $id,
            'sort' => 2
        ]);

        $this->contactsRepository->create([
            'name' => 'city' . $generator .date("YmdHis"),
            'title' => 'City: ',
            'value' => null,
            'parent_id' => $id,
            'sort' => 3
        ]);

        $this->redirect('Contact:edit', $id);

    }

    /**
     * @return Form
     */
    protected function createComponentElementForm(): Form
    {
        $form = new Form;

        $form->addText('title', 'Title');

        $form->addText('value', 'Value');

        $form->addSubmit('submit', 'Send');
        $form->onSuccess[] = [$this, 'onSubmit'];

        return $form;

    }

    public function onSubmit(Form $form, $values)
    {
        $id = $this->getParameter('parentId');
        $count = $this->contactsRepository->find(['parent_id' => $id, 'deleted_at' => null]);

        $this->contactsRepository->create([
            'name' => 'element' . $this->generateString->generateRandomString(5) .date("YmdHis"),
            'title' => $values->title ,
            'value' => $values->value,
            'parent_id' => $this->parentId,
            'sort' => count($count) + 1
        ]);

        $this->redirect('Contact:edit', $this->parentId);

    }

}
