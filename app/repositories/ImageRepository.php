<?php

namespace App\Repositories;

use Nette\Utils\Strings;
use Nette\Utils\Image;

final class ImageRepository extends BaseRepository
{
    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'images';
    }

    /**
     * @param $images
     * @param array $data
     * @param $path
     * @param null $thumbHeight
     * @param null $thumbWidth
     * @return array
     */
    public function upload($images, $data = [], $path, $thumbHeight = null, $thumbWidth = null)
    {
        $imageIds = [];

        foreach ($images as $image) {
            $name = $this->find(['name' => $image->name]);
            if ($image->name != $name) {
                $Image = Image::fromFile($image);

                $save = $path . Strings::webalize($image->name, '.');
                $Image->save($save);

                $imageIds[] = $this->getTable()->insert([
                    'name' => Strings::webalize($image->name, '.'),
                    'alt' => null,
                    'size' => $image->size . " bytes",
                    'path' => $save,
                    'extension' => pathinfo($save, PATHINFO_EXTENSION)
                ]);
                $this->uploadThumbnail($image, $thumbHeight, $thumbWidth, $imageIds, $path);
            }
        }

        return $imageIds;
    }

    private function uploadThumbnail($item, $height, $width, $parent, $path)
    {
        $save = $path . Strings::webalize("'thumbnail-' $item->name ", '.');
        $image = Image::fromFile($item);

        $image->resize($width, $height);

        $image->save($save);

        foreach ($parent as $aaa) {

            $this->getTable()->insert([
                'name' => Strings::webalize("'thumbnail-'  $item->name ", '.'),
                'alt' => null,
                'size' => $item->size . " bytes",
                'path' => $save,
                'extension' => pathinfo($save, PATHINFO_EXTENSION),
                'parent_id' => $aaa
            ]);
        }


    }

    public function uploadSingle($image, $data = null, $path)
    {
        $name = $this->find(['name' => $image->name]);
        if ($image->name != $name) {
            $save = SAVING_PATH . '/' . $path . '/' . $image->name;
            $image->move($save);

            $imageId = $this->getTable()->insert([
                'name' => $image->name,
                'alt' => $data,
                'size' => $image->size . " bytes",
                'path' => $save,
                'extension' => pathinfo($save, PATHINFO_EXTENSION)
            ]);
            return $imageId;
        }
        return false;

    }

}