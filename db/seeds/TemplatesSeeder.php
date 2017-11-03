<?php

use Phinx\Seed\AbstractSeed;

class TemplatesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'template_name' => 'counseling.latte',
                'category_id' => 4
            ]
        ];

        $table = $this->table('templates');
        $table->insert($data)->save();
    }
}
