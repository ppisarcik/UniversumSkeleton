<?php

namespace App\Repositories;

class ArticleImageRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'article_image';
    }


}