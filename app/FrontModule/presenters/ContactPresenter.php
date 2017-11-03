<?php

namespace App\FrontModule\Presenters;

use Nette;
use App\Repositories\ContactsRepository;

class ContactPresenter extends BasePresenter
{

    /** @var ContactsRepository @inject */
    public $contactsRepository;

    public function renderDefault()
    {
        $contacts = $this->contactsRepository->findPairs('value', 'name', [], 'id ASC');
        $this->template->contacts = $contacts ? $contacts : false;
    }

}
