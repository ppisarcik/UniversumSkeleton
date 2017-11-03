<?php
namespace App\Repositories;



final class MenuRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'menu';
    }

}