<?php

use Phinx\Seed\AbstractSeed;

class SettingsSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [
            array(
                'title' => 'Názov stránky',
                'name' => '',
                'value' => ''
            ),
            array(
                'title' => 'Názov stránky',
                'name' => 'site_description',
                'value' => ''
            ),

            array(
                'title' => 'Názov stránky',
                'name' => 'site_keywords',
                'value' => ''
            )
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
