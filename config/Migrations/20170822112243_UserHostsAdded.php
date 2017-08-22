<?php
use Migrations\AbstractMigration;

class UserHostsAdded extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('user_hosts')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('project_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('host_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id', 'project_id', 'host_id'])
            ->addColumn('rac', 'decimal', [
                'default' => '0.000000',
                'null' => false,
                'precision' => 15,
                'scale' => 6,
            ])
            ->addColumn('rac_update_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {

        $this->dropTable('user_hosts');
    }
}

