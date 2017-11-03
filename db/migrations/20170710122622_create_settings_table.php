<?php

use Phinx\Migration\AbstractMigration;

class CreateSettingsTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('settings');
        $table
            ->addColumn('title', 'string')
            ->addColumn('name', 'string')
            ->addColumn('value', 'text', ['null' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('contacts');
    }
}
