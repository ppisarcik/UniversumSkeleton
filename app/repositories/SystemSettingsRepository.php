<?php

namespace App\Repositories;


class SystemSettingsRepository extends BaseRepository
{
    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'system_settings';
    }
}