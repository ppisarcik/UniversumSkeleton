<?php

namespace App\Repositories;

class UserRepository extends BaseRepository
{
    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'users';
    }
}