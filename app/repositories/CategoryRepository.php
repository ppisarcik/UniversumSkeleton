<?php

namespace App\Repositories;

final class CategoryRepository extends BaseRepository
{
    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'categories';
    }

    public function getSubCategory($category = null)
    {

        return $category;

    }

    /*public function buildTree(array $elements, $parentId = 1)
    {

        $branch = array();

        foreach ($elements as $element) {

            $element = $element->toArray();

            if ($element['parent_id'] == $parentId) {

                $children = $this->buildTree($elements, $element['id']);

                $element['children'] = [];

                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
            }
        }
        return $branch;
    }*/

}