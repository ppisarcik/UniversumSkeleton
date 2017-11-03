<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('categories');
        $table
            ->addColumn('title', 'string', ['limit' => 100], ['null' => true])
            ->addColumn('content', 'text', ['null' => true])
            ->addTimestamps()
            ->addColumn('deleted_at', 'timestamp')
            ->addColumn('status', 'string', ['default' => 'show'])
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
