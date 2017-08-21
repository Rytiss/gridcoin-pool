<?php
use Migrations\AbstractMigration;

class ProjectsTableAdded extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('projects')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('url', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('url_signature', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('active', 'tinyinteger', [
                'default' => '0',
                'limit' => 4,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {

        $this->dropTable('projects');
    }
}

