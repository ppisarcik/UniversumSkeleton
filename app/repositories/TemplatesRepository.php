<?php

namespace App\Repositories;

class TemplatesRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'templates';
    }

}