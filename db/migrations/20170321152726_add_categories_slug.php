<?php

use Phinx\Migration\AbstractMigration;

class AddCategoriesSlug extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('categories');
        $table
            ->addColumn('slug', 'string', ['limit' => 100])
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
