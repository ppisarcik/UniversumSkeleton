<?php
namespace App\AdminModule\Components\Grid;

use App\AdminModule\Components\BaseControl;
use App\Repositories\CategoryImageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RelationsRepository;
use App\Repositories\SettingsRepository;
use Nette\DI\Container;
use Tracy\Debugger;
use Ublaboo\DataGrid\DataGrid;

interface GridControlFactory
{
    /**
     * @param $repository
     * @param $typeId
     * @param $relationTableName
     * @param $link
     * @return GridControl
     */
    public function create($repository, $typeId, $relationTableName, $link);
}

class GridControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;
    private $imageRepository;
    private $relationsRepository;
    /** @var CategoryImageRepository @inject */
    public $categoryImageRepository;

    /** @var array $images */
    private $images = [];

    /** @var int */
    private $typeId;

    /** @var string */
    private $repository;

    /** @var string */
    private $relationTableName;

    /** @var string */
    private $link;

    /** @var SettingsRepository */
    private $settingsRepository;


    public function __construct(
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        RelationsRepository $relationsRepository,
        CategoryImageRepository $categoryImageRepository,
        $repository = null,
        $typeId = null,
        $relationTableName = null,
        $link = null,
        SettingsRepository $settingsRepository
    )
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->categoryImageRepository = $categoryImageRepository;
        $this->repository = $repository;
        $this->typeId = $typeId;
        $this->relationTableName = $relationTableName;
        $this->link = $link;
        $this->settingsRepository = $settingsRepository;
    }

    public function handleDelete($id)
    {

        /*$this->repository->get(['id' => $id]);
        $this->relationsRepository->deleteRelation($this->relationTableName, [$this->typeId => $id]);
        $this->relationsRepository->deleteRelation('templates', [$this->typeId => $id]);
        $this->relationsRepository->deleteRelation('category_article', [$this->typeId => $id]);
        $this->repository->update(['id' => $id], ['image_id' => null]);
        $this->repository->update(['parent_id' => $id], ['parent_id' => null]);
        $this->repository->delete(['id' => $id]);*/

        $this->repository->update(['id' => $id], ['deleted_at' => date('Y-m-d G:i:s')]);
        Debugger::barDump($this->repository);

        if ($this->presenter->isAjax()) {
            $this->presenter->redrawControl('flashes');
            $this['grid']->reload();
        } else {
            $this->presenter->redirect('this');
        }
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/grid.latte');
        $template->render();
    }

    /**
     * @param $name
     * @return DataGrid
     */
    public function createComponentGrid($name)
    {
        $grid = new DataGrid($this, $name);

        $grid->setDataSource($this->repository->find(['deleted_at' => 'null', 'status' => 'show']));

        $grid->addColumnText('title', 'Title')
            ->setSortable()
            ->setEditableCallback([$this, 'quickEdit'])
            ->setFilterText(['title']);

        $grid->addColumnText('content', 'Content')
            ->setSortable();

        $grid->addColumnDateTime('created_at', 'Date')
            ->setSortable();

        $grid->addAction('delete', '', 'delete!', ['id'])
            ->setIcon('trash-o')
            ->setTitle('Delete')
            ->setClass('ajax')
            ->setConfirm('Do you really want to delete row %s?', 'title');

        $grid->addAction('id', '',  "$this->link" . ":edit")
            ->setTitle('Edit')
            ->setIcon('pencil');

        $grid->setItemsPerPageList([10]);

        $grid->addGroupAction('Delete')
            ->onSelect[] = [$this, 'deleteAll'];

        $grid->setTemplateFile(__DIR__ . '/customGrid.latte');

        return $grid;

    }

    public function deleteAll($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        foreach ($ids as $id) {
            $this->repository->update(['id' => $id], ['deleted_at' => date('Y-m-d G:i:s')]);
        }

        $this->presenter->flashMessage('Successfully deleted from database');

        $this->presenter->redirect('this');
    }

    public function quickEdit($id, $value)
    {
        $this->repository->update(['id' => $id], ['title' => $value]);
    }


}
