<?php

use Phinx\Migration\AbstractMigration;

class CreateOrderTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('order');
        $table
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('phone', 'string')
            ->addColumn('city', 'string')
            ->addColumn('message', 'text', ['null' => true])
            ->addColumn('doors', 'string', ['null' => true])
            ->addColumn('floors', 'string', ['null' => true])
            ->addColumn('doors_quantity', 'integer', ['null' => true])
            ->addColumn('floors_quantity', 'integer', ['null' => true])
            ->addColumn('status', 'string', ['default' => 'waiting'])
            ->addTimestamps()
            ->addColumn('deleted_at', 'timestamp')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
