<?php
namespace App\FrontModule\Components\Shops;

use App\AdminModule\Components\BaseControl;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ContactsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Nette\Image;
use Tracy\Debugger;

interface ShopsControlFactory
{
    /** @return ShopsControl */
    public function create();
}

class ShopsControl extends BaseControl
{
    /** @var ContactsRepository */
    private $contactsRepository;

    /** @var ImageRepository */
    private $imageRepository;


    public function __construct(ContactsRepository $contactsRepository, ImageRepository $imageRepository)
    {
        parent::__construct();
        $this->contactsRepository = $contactsRepository;
        $this->imageRepository = $imageRepository;
    }

    public function render($params = [])
    {
        $contacts = $this->contactsRepository->findPairs('value', 'name', [] ,'id ASC');
        $mainContact = $this->contactsRepository->find(['deleted_at' => null]);
        $contactTree = $this->contactsRepository->buildTree($mainContact, null);

        $tree = [];
        foreach ($contactTree as $item) {
            $image =  $this->imageRepository->get(['id' => $item['image_id']]);
            $item['image'] = $image['name'];
            $tree[] = $item;
        }

        $template = $this->template;
        $template->contacts = $contacts;
        $template->contactTree = $tree;
        $template->path = IMAGES_PATH . "/contacts/";
        $template->setFile(__DIR__ . '/shops.latte');
        $template->render();
    }

}
