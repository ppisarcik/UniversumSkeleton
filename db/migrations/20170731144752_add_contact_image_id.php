<?php

use Phinx\Migration\AbstractMigration;

class AddContactImageId extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('contacts');
        $table
            ->addColumn('image_id', 'integer',  ['null' => true])
            ->addForeignKey('image_id', 'images', 'id')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('contacts');
    }
}
