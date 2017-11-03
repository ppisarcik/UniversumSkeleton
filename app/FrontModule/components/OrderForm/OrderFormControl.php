<?php
namespace App\FrontModule\Components\OrderForm;

use App\FrontModule\Components\BaseControl;
use App\Repositories\OrderRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI;

interface OrderFormControlFactory
{
    /** @return OrderFormControl */
    public function create();
}

final class OrderFormControl extends BaseControl
{
    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/OrderForm.latte');
        $template->render();
    }

    /**
     * Component order form
     *
     * @return Form
     */
    protected function createComponentOrderForm()
    {
        $mainFloors = $this->categoryRepository->get(['id' => 2]);

        $doors = [];
        $floors = [];

        $findFloors = $this->relationsRepository->getItemsOfRelations($mainFloors, 'id DESC', 'article');

        if ($findFloors) {
            foreach ($findFloors as $item) {
                $floors[$item->title] = $item->title;
            }
        }

        $subCategories = $this->categoryRepository->find(['parent_id' => 3], 'id ASC');

        foreach ($subCategories as $categoryId => $category) {

            $categoryTitle[$category->title][] = $category->title;
            $articles = $this->relationsRepository->getItemsOfRelations($category, 'id ASC', 'article');

            foreach ($articles as $article) {
                $doors[$category->title][$article->title] = $article->title;
            }
        }

        $form = new Form;
        $form->addSelect('floorsSelect', 'Podlahy', $floors)
            ->setPrompt('Vyberte typ podlahy');
        $form->addInteger('floorsQuantity', 'Plocha:')
            ->setRequired(FALSE);
        $form->addSelect('doorsSelect', 'Dvere', $doors)
            ->setPrompt('Vyberte typ dverí');
        $form->addInteger('doorsQuantity', 'Mnozstvo:')
            ->setRequired(FALSE);
        $form->addText('name', 'Meno a priezvisko:')
            ->setRequired('Titulok musí byť vložený');
        $form->addEmail('email', 'Email: ')
            ->setRequired('Titulok musí byť vložený');
        $form->addInteger('phone', 'Telefonne cislo');
        $form->addText('city', 'Mesto: ')
            ->setRequired('Titulok musí byť vložený');
        $form->addTextArea('message', 'Vasa sprava: ');
        $form->addSubmit('send', 'Uložiť do databazy');

        $form->onSuccess[] = [$this, 'onSubmit'];
        return $form;
    }

    public function onSubmit(UI\Form $form, $values)
    {
        $order = [
            'name' => $values['name'],
            'email' => $values['email'],
            'phone' => $values['phone'],
            'city' => $values['city'],
            'message' => $values['message'],
            'doors' => $values['doorsSelect'],
            'doors_quantity' => $values['doorsQuantity'],
            'floors' => $values['floorsSelect'],
            'floors_quantity' => $values['floorsQuantity'],
            'status' => 'waiting'
        ];

        $insert = $this->orderRepository->create($order);

        if ($insert) {
            $this->presenter->flashMessage("Success");
        } else {
            $this->presenter->flashMessage('Error');
        }

        $this->presenter->redirect('Homepage:default');
    }

}
