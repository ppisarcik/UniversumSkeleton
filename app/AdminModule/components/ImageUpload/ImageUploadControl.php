<?php

namespace App\AdminModule\Components\ImageUpload;

use App\AdminModule\Components\BaseControl;
use App\Repositories\CategoryImageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MenuRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Database\IRow;
use Nette\Neon\Exception;
use Tracy\Debugger;
use Nette\Utils\Html;

interface ImageUploadControlFactory
{

    /**
     * @param null $path
     * @param null $repository
     * @param null $data
     * @param null $relationTable
     * @param null $relationId
     * @param null $typeParent
     * @param null $savingPath
     * @param null $relationRepositoryTable
     * @param null $id
     * @return ImageUploadControl
     */
    public function create(
        $path = null,
        $repository = null,
        $data = null,
        $relationTable = null,
        $relationId = null,
        $typeParent = null,
        $savingPath = null,
        $relationRepositoryTable = null,
        $id = null

    );
}

class ImageUploadControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var CategoryImageRepository */
    private $categoryImageRepository;

    /** @var integer categoryId */
    private $categoryId;

    /** @var string path */
    private $path;

    /** @var IRow */
    private $repository;

    /** @var IRow */
    private $data;

    /** @var array $images */
    private $images = [];

    /** @var string $relationTable */
    private $relationTable;

    /** @var string $relationId */
    private $relationId;

    /** @var string $typeParent */
    private $typeParent;

    /** @var string $savingPath */
    private $savingPath;

    /** @var $relationRepositoryTable */
    private $relationRepositoryTable;

    /** @var  integer */
    private $id;

    private $imageRepository;
    private $relationsRepository;
    private $menuRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        RelationsRepository $relationsRepository,
        MenuRepository $menuRepository,
        CategoryImageRepository $categoryImageRepository,
        $repository = null,
        $path = null,
        $data = null,
        $relationTable = null,
        $relationId = null,
        $typeParent = null,
        $savingPath = null,
        $relationRepositoryTable = null,
        $id = null
    )
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->menuRepository = $menuRepository;
        $this->categoryImageRepository = $categoryImageRepository;
        $this->repository = $repository;
        $this->path = $path;
        $this->data = $data;
        $this->relationTable = $relationTable;
        $this->relationId = $relationId;
        $this->typeParent = $typeParent;
        $this->savingPath = $savingPath;
        $this->relationRepositoryTable = $relationRepositoryTable;
        $this->id = $id;
    }

    public function handleDeleteImage()
    {

        $imageId = $this->getParameter('imageId');


        $this->repository->update(['id' => $this->data->id], ['image_id' => null]);
        $this->data->related('image')->where(['image_id' => $imageId])->delete();


        $this->imageRepository->delete(['id' => $imageId]);

        $this->flashMessage('Successfully deleted from database');

        if ($this->presenter->isAjax()) {
            $this->redrawControl('images');
            $this->redrawControl('flash');
        } else {
            $this->presenter->redirect('Category:default');
        }
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/ImageUpload.latte');

        $relatedImage = $this->data->related('image')->where([$this->relationId => $this->id])->fetchAll();

        $images = [];
        $getImages = [];

        foreach ($relatedImage as $item) {
            $getImages[] = $this->imageRepository->get(['id' => $item->id]);
        }

        foreach ($getImages as $item) {
            if ($item != false) {
                $images[] = $item;
            }
        }

        $template->path = $this->path;

        $template->images = $images;
        $template->render();
    }

    /**
     * Component image form
     *
     * @return Form
     */
    protected function createComponentImageForm()
    {


        $images = $this->relationsRepository->getItemsOfRelations($this->data, 'id ASC', 'image');

        $image = [];
        $imageIds = [];

        foreach ($images as $item) {
            $test = $this->imageRepository->get(['parent_id' => $item->id]);

            $image[$item->id] = ['img_path' => $this->path . $test->name, 'img_id' => $item->id, 'img_name' => $item->name, 'img_size' => $item->size];
            $imageIds[$item->id] = $item->name;
        }

        $form = new Form();
        $form->addMultiUpload('image', 'Pridať obrázok:')
            ->setRequired(FALSE)
            ->addRule(Form::IMAGE, 'The uploaded file must be image in format JPEG, GIF or PNG.')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je %d kB.', 6000 * 1024);

        $form->addCheckboxList('imageList', 'Image List: ', $image);
        $form['imageList']->setItems($this->createHtmlArray($image));

        $form->setDefaults(['imageList' => array_keys($image)]);
        $form->addRadioList('radio', 'RadioList: ', $imageIds);
        try {
            $form->setDefaults([
                'radio' => $this->data->image_id
            ]);
        } catch (\Exception $e) {
            Debugger::log($e);
        }


        $form->addSubmit('send', 'Uložiť do databazy');
        $form->onSuccess[] = [$this, 'onSubmit'];
        return $form;
    }

    public function onSubmit(Form $form, $values)
    {
        $path = $this->savingPath;
        $id = $this->data->id;
        $image = $values->image;
/*
        foreach ($image as $item) {
            $ext = pathinfo($item->name, PATHINFO_EXTENSION);
            if ($ext != "jpeg" || $ext != "gif" || $ext != "png") {
                $this->presenter->flashMessage('The uploaded file must be image in format JPEG, GIF or PNG!', 'warning');
                $this->presenter->redirect('this');

            }
        }
        */
        $data = [
            'image_id' => $values['radio'],
            'updated_at' => date('Y-m-d G:i:s')
        ];

        $this->repository->update(['id' => $id], $data);

        $imageId = $this->imageRepository->upload($image, $values, $path, 150, 150);

        $compare = array_diff($this->images, $values->imageList);

        if (!empty($compare)) {

            if ($this->repository->get(['image_id' => $compare])) {
                $this->presenter->flashMessage('Cannot delete main image!', 'danger');
                $this->presenter->redirect('this');
            } else {
                $this->data->related('image')->where(['image_id' => $compare])->delete();
            }


            }


        foreach ($imageId as $value) {
            $categoryImage = [
                $this->relationId => $id,
                'image_id' => $value['id']
            ];

            $this->relationsRepository->attach($this->relationTable, $categoryImage);
        }

        $this->presenter->flashMessage("Saved!", 'success');
        $this->presenter->redirect('this');
    }

    public function createHtmlArray($array)
    {
        $newArray = [];
        foreach ($array as $item) {

            $data_image = [
                $item['img_id'] => [
                    'image_name' => $item['img_name'],
                    'image_size' => $item['img_size']
                ]
            ];

            $this->images[] = $item['img_id'];
            $el = Html::el('span')
                ->addHtml(Html::el('img')->addAttributes(['src' => $item['img_path'], 'data-image' => $data_image]))
                ->addHtml(Html::el('a')->href('/admin/image/edit/' . $item['img_id'], ['idParent' => $this->data->id, 'typeParent' => $this->typeParent, 'renderPath' => $this->path, 'relationId' => $this->relationId])->setText('Edit'));

            $newArray[$item['img_id']] = $el;

        }
        return $newArray;
    }
}
