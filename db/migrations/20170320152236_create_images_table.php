<?php

use Phinx\Migration\AbstractMigration;

class CreateImagesTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('images');
        $table
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('title', 'string', ['null' => true])
            ->addColumn('alt', 'text', ['null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('size', 'integer')
            ->addColumn('parent_id', 'integer', ['null' => true])
            ->addForeignKey('parent_id', 'images', 'id')
            ->addTimestamps()
            ->addColumn('deleted_at', 'timestamp')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
