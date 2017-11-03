<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryImageTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('category_image');
        $table
            ->addColumn('category_id', 'integer')
            ->addColumn('image_id', 'integer',  ['null' => true])
            ->addForeignKey('category_id', 'categories', 'id')
            ->addForeignKey('image_id', 'images', 'id')
            ->addIndex(['category_id', 'image_id'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('category_image');
    }
}
