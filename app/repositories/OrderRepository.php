<?php

namespace App\Repositories;

final class OrderRepository extends BaseRepository
{
    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'order';
    }

}