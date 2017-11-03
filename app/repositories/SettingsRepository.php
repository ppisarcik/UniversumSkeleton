<?php

namespace App\Repositories;

class SettingsRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'settings';
    }

}