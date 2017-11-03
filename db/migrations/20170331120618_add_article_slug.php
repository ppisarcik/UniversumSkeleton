<?php

use Phinx\Migration\AbstractMigration;

class AddArticleSlug extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('articles');
        $table
            ->addColumn('slug', 'string')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('articles');
    }
}
