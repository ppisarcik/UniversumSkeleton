<?php

use Phinx\Migration\AbstractMigration;

class CreateContactImageTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('contact_image');
        $table
            ->addColumn('contact_id', 'integer')
            ->addColumn('image_id', 'integer',  ['null' => true])
            ->addForeignKey('contact_id', 'contacts', 'id')
            ->addForeignKey('image_id', 'images', 'id')
            ->addIndex(['contact_id', 'image_id'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('contact_image');
    }
}
