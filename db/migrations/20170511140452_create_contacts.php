<?php

use Phinx\Migration\AbstractMigration;

class CreateContacts extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('contacts');
        $table
            ->addColumn('name', 'string')
            ->addColumn('title', 'string')
            ->addColumn('value', 'text', ['null' => true])
            ->addColumn('parent_id', 'integer', ['null' => true])
            ->addTimestamps()
            ->addColumn('deleted_at', 'timestamp', ['null' => true])
            ->addForeignKey('parent_id', 'contacts', 'id')
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
