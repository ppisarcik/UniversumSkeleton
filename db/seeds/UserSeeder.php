<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => \Nette\Security\Passwords::hash('admin'),
                'email' => 'admin@admin.sk',
                'role' => 'administrator',
                'first_name' => 'admin',
                'last_name' => 'admin'
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
