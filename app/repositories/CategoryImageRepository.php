<?php

namespace App\Repositories;

class CategoryImageRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'category_image';
    }


}