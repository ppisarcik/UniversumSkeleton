<?php

namespace App\Repositories;

class CategoryArticleRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'category_article';
    }


}