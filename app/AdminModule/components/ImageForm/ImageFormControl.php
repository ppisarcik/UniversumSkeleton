<?php

namespace App\AdminModule\Components\ImageForm;

use App\AdminModule\Components\BaseControl;
use App\Repositories\ArticleImageRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryImageRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MenuRepository;
use App\Repositories\RelationsRepository;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Tracy\Debugger;
use Nette\Utils\Strings;

interface ImageFormControlFactory
{
    /**
     * @param $parentId
     * @param $typeParent
     * @param $renderPath
     * @param $repository
     * @param $nameRelationId
     * @return ImageFormControl
     * @internal param $relationId
     */
    public function create($parentId, $typeParent, $renderPath, $repository, $nameRelationId);
}

class ImageFormControl extends BaseControl
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var CategoryImageRepository */
    private $categoryImageRepository;

    /** @var integer categoryId */
    private $relationId;

    /** @persistent */
    private $parentId;

    /** @persistent */
    private $typeParent;

    /** @var $image */
    private $images;

    /** @var $image */
    private $image;

    /** @var $renderPath */
    private $renderPath;

    /** @var $repository */
    private $repository;

    /** @var ArticleImageRepository @inject */
    public $articleImageRepository;

    /** @var ArticleRepository @inject */
    public $articleRepository;

    private $nameRelationId;


    private $imageRepository;
    private $relationsRepository;
    private $menuRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository,
        RelationsRepository $relationsRepository,
        MenuRepository $menuRepository,
        CategoryImageRepository $categoryImageRepository,
        ArticleRepository $articleRepository,
        ArticleImageRepository $articleImageRepository,
        $parentId = null,
        $typeParent = null,
        $renderPath = null,
        $repository = null,
        $nameRelationId = null
    )
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->relationsRepository = $relationsRepository;
        $this->menuRepository = $menuRepository;
        $this->categoryImageRepository = $categoryImageRepository;
        $this->articleRepository = $articleRepository;
        $this->articleImageRepository = $articleImageRepository;
        $this->typeParent = $typeParent;
        $this->parentId = $parentId;
        $this->renderPath = $renderPath;
        $this->repository = $repository;
        $this->nameRelationId = $nameRelationId;
    }


    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/ImageForm.latte');
        $template->render();
    }

    /**
     * Component image form
     *
     * @return Form
     */
    protected function createComponentImageForm()
    {

        $images = [];
        $imageIds = [];
        $hasNodes = false;
        $nameRelation = $this->nameRelationId;

        $form = new Form;

        $id = $this->presenter->getParameter('id');

        $image = $this->imageRepository->get(['id' => $id]);
        $this->image = $image;

        if ($this->repository) {

            $relationImage = $this->repository->get(['id' => $this->parentId])->related('image')->where(['image_id' => $image])->fetch();
            $this->relationId = $relationImage->$nameRelation;
            $hasNodes = $this->repository->get(['image_id' => $id]);
        }

        $images[$image->id] = ['img_path' => $this->renderPath . $this->image->name, 'img_id' => $image->id];
        $imageIds[$image->id] = $image->name;

        $form->addText('title', 'Title: ');
        $form->addText('alt', 'Alternative text: ');
        $form->addTextarea('description', 'Description: ');
        $form->addCheckbox('mainImage', 'Set as main image');
        $form->addImage('image', $this->renderPath . $this->image->name);
        $form->addHidden('presenter', Strings::firstUpper($this->typeParent));
        $form->addHidden('relationId', $this->relationId);

        Html::el('span')
            ->addHtml(Html::el('img')->addAttributes(['src' => $this->renderPath . $this->image->name]));

        $form->addSubmit('send', 'Save');

        $form->setDefaults([
            'title' => $image->title,
            'alt' => $image->alt,
            'description' => $image->description
        ]);

        if ($hasNodes) {
            $form->setDefaults(['mainImage' => true]);
        }
        $form->onSuccess[] = [$this, 'onSubmit'];

        return $form;
    }

    public function onSubmit(Form $form, $values)
    {
        $imageId = $this->presenter->getParameter('id');
        $image = [
            'title' => $values['title'],
            'alt' => $values ['alt'],
            'description' => $values ['description']
        ];

        $mainImage = ['image_id' => $imageId];

        if ($values->mainImage) {
            if ($values->presenter === "Category") {
                $this->categoryRepository->update(['id' => $values->relationId], $mainImage);
            } else {
                $this->articleRepository->update(['id' => $values->relationId], $mainImage);
            }

        } else {
            if ($values->presenter === "Category") {
                $this->categoryRepository->update(['id' => $values->relationId], ['image_id' => null]);
            } else {
                $this->articleRepository->update(['id' => $values->relationId], ['image_id' => null]);
            }
        }
        $this->imageRepository->update(['id' => $imageId], $image);
        $this->presenter->redirect($this->typeParent . ":edit", $this->parentId);
        $this->presenter->flashMessage("Saved");


    }

    public function createHtml($item)
    {
        $newArray = [];
        $this->images = $item->id;
        $el = Html::el('span')
            ->addHtml(Html::el('img')->addAttributes(['src' => $this->renderPath . $this->image->name]));
        $newArray[$item->id] = $el;

        return $newArray;
    }
}
