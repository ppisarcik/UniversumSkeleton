<?php

namespace App\Repositories;

final class ContactsRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'contacts';
    }


}