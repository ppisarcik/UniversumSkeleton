<?php

use Phinx\Migration\AbstractMigration;

class AddCategoryParentId extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('categories');
        $table
            ->addColumn('parent_id', 'integer', ['null' => true])
            ->addColumn('image_id', 'integer', ['null' => true])
            ->addForeignKey('parent_id', 'categories', 'id')
            ->addForeignKey('image_id', 'images', 'id')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
