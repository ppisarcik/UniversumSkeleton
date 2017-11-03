<?php
namespace App\AdminModule\Components\Menu;

use App\AdminModule\Components\BaseControl;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MenuRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Tracy\Debugger;

interface MenuFormControlFactory
{
    /** @return MenuFormControl */
    public function create();
}

class MenuFormControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;
    private $imageRepository;
    private $relationsRepository;
    private $menuRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        RelationsRepository $relationsRepository,
        MenuRepository $menuRepository
    ){
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->menuRepository = $menuRepository;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/MenuForm.latte');
        $template->render();
    }

    /**
     * Component category form
     *
     * @return Form
     */
    protected function createComponentMenuForm()
    {

        $form = new Form;
        $form->addSelect('title', 'Titulok:')
            ->setRequired('Titulok musí byť vložený');

        return $form;
    }
}
