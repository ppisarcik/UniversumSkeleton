<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryArticleTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('category_article');
        $table
            ->addColumn('article_id', 'integer')
            ->addColumn('category_id', 'integer')
            ->addForeignKey('article_id', 'articles', 'id')
            ->addForeignKey('category_id', 'categories', 'id')
            ->addIndex(['article_id', 'category_id'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('category_article');
    }
}
