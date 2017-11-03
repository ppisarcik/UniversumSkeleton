<?php

use Phinx\Migration\AbstractMigration;

class AddImagePathExtension extends AbstractMigration
{
    /**
     * Migrate Up
     */
    public function up()
    {
        $table = $this->table('images');
        $table
            ->addColumn('path', 'text')
            ->addColumn('extension', 'string')
            ->save();

    }
    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('images');
    }
}
