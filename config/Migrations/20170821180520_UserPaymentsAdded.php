<?php
use Migrations\AbstractMigration;

class UserPaymentsAdded extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->changeColumn('admin', 'tinyinteger', [
                'default' => '0',
                'limit' => 4,
                'null' => false,
            ])
            ->update();

        $this->table('projects')
            ->addColumn('authenticator', 'string', [
                'after' => 'active',
                'default' => null,
                'length' => 50,
                'null' => true,
            ])
            ->update();

        $this->table('users')
            ->addColumn('address', 'string', [
                'after' => 'password',
                'default' => null,
                'length' => 35,
                'null' => true,
            ])
            ->addColumn('last_payment', 'datetime', [
                'after' => 'address',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('unpaid', 'decimal', [
                'after' => 'last_payment',
                'default' => '0.00000000',
                'null' => false,
                'precision' => 17,
                'scale' => 8,
            ])
            ->addColumn('magnitude', 'integer', [
                'after' => 'unpaid',
                'default' => '0',
                'length' => 10,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('projects')
            ->removeColumn('authenticator')
            ->update();

        $this->table('users')
            ->changeColumn('admin', 'tinyinteger', [
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->removeColumn('address')
            ->removeColumn('last_payment')
            ->removeColumn('unpaid')
            ->removeColumn('magnitude')
            ->update();
    }
}

