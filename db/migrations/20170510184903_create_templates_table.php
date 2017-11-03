<?php

use Phinx\Migration\AbstractMigration;

class CreateTemplatesTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('templates');
        $table
            ->addColumn('template_name', 'string')
            ->addColumn('category_id', 'integer')
            ->addForeignKey('category_id', 'categories', 'id')
            ->addIndex(['category_id'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('templates');
    }
}
