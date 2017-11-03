<?php

use Phinx\Seed\AbstractSeed;

class OrderSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            array(
                'name' => 'Peter Pisarcik',
                'email' => 'peter.p123321@gmail.com',
                'phone' => '0949 418 926',
                'city' => 'Bardejov',
                'message' => 'Zdravim, chcem si objednat dvere',
                'status' => 'waiting'
            ),

            array(
                'name' => 'David Durco',
                'email' => 'kich182@icloud.com',
                'phone' => '0950 432 329',
                'city' => 'Bardejov',
                'message' => 'Zdravim, chcem si objednat podlahy',
                'status' => 'waiting'
            )
        ];

        $table = $this->table('order');
        $table->insert($data)->save();
    }
}
