<?php

use Phinx\Migration\AbstractMigration;

class CreateArticleTable extends AbstractMigration
{
    /**
     * Migrate Up
     */
    public function up()
    {
        $table = $this->table('articles');
        $table
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('description', 'text')
            ->addColumn('content', 'text')
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
        $this->dropTable('article');
    }
}
