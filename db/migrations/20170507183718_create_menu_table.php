<?php

use Phinx\Migration\AbstractMigration;

class CreateMenuTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('menu');
        $table
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('link', 'string', ['limit' => 255])
            ->addColumn('parent_id', 'integer', ['null' => true])
            ->addColumn('special', 'integer', 0)
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
