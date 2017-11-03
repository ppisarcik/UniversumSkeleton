<?php

use Phinx\Migration\AbstractMigration;

class CreateArticleImageTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('article_image');
        $table
            ->addColumn('article_id', 'integer')
            ->addColumn('image_id', 'integer')
            ->addForeignKey('article_id', 'articles', 'id')
            ->addForeignKey('image_id', 'images', 'id')
            ->addIndex(['article_id', 'image_id'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('article_image');
    }
}
