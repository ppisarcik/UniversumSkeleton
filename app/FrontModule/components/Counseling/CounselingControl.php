<?php
namespace App\FrontModule\Components\Counseling;

use App\FrontModule\Components\BaseControl;

interface CounselingControlFactory
{
    /** @return CounselingControl */
    public function create();
}

final class CounselingControl extends BaseControl
{


    public function render()
    {
        $counseling = $this->categoryRepository->get(['slug' => 'poradna']);
        $articles = $this->relationsRepository->getItemsOfRelations($counseling, 'id ASC', 'article');

        $this->template->counseling = $counseling;
        $this->template->articles = $articles;

        $this->template->setFile(__DIR__ . '/counseling.latte');
        $this->template->render();

    }


}
