<?php

use Phinx\Seed\AbstractSeed;

class MenuSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            array(
                'name' => 'Úvod',
                'link' => '/',
                'parent_id' => null
            ),

            array(
                'name' => 'O nás',
                'link' => '/clanok/o-nas',
                'parent_id' => null
            ),

            array(
                'name' => 'Kategórie',
                'link' => '#',
                'parent_id' => null,
                'special' => 1
            ),

            array(
                'name' => 'Poradňa',
                'link' => '/kategoria/poradna',
                'parent_id' => null
            ),

            array(
                'name' => 'Kontakt',
                'link' => '/kontakt',
                'parent_id' => null
            ),
        ];

        $table = $this->table('menu');
        $table->insert($data)->save();
    }
}
