<?php

use Phinx\Seed\AbstractSeed;

class ContactsSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [

            array(
                'name' => 'predajna1',
                'title' => 'Predajna',
                'value' => 'Podlahové štúdio',
                'parent_id' => null
            ),

            array(
                'name' => 'predajna2',
                'title' => 'Predajna',
                'value' => 'Areál FK Stavebniny',
                'parent_id' => null
            ),

            array(
                'name' => 'tel1',
                'title' => 'Telefón',
                'value' => '+421907479900',
                'parent_id' => 1
            ),

            array(
                'name' => 'tel2',
                'title' => 'Telefón',
                'value' => '0907147102',
                'parent_id' => 2
            ),

            array(
                'name' => 'email',
                'title' => 'Email',
                'value' => 'info@podlahyadvere.sk',
                'parent_id' => 1
            ),

            array(
                'name' => 'adresa1',
                'title' => 'Adresa',
                'value' => 'Partizánska 6',
                'parent_id' => 1
            ),

            array(
                'name' => 'adresa2',
                'title' => 'Adresa',
                'value' => 'Duklianska 12',
                'parent_id' => 2
            ),

            array(
                'name' => 'mesto',
                'title' => 'Mesto',
                'value' => '085 01 Bardejov',
                'parent_id' => 1
            ),

            array(
                'name' => 'obrazok1',
                'title' => 'Obrázok',
                'parent_id' => 1
            ),

            array(
                'name' => 'obrazok2',
                'title' => 'Obrázok',
                'parent_id' => 2
            )

        ];

        $table = $this->table('contacts');
        $table->insert($data)->save();
    }
}
