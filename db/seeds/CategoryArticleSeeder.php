<?php

use Phinx\Seed\AbstractSeed;

class CategoryArticleSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            /*Clanky pod podlahami*/
            array(
                'article_id' => 1,
                'category_id' => 2,
            ),

            array(
                'article_id' => 2,
                'category_id' => 2,
            ),

            array(
                'article_id' => 3,
                'category_id' => 2,
            ),

            array(
                'article_id' => 4,
                'category_id' => 2,
            ),

            /* Prislusenstvo podkategoria */
            array(
                'article_id' => 5,
                'category_id' => 8,
            ),

            array(
                'article_id' => 6,
                'category_id' => 8,
            ),

            array(
                'article_id' => 7,
                'category_id' => 8,
            ),

            array(
                'article_id' => 9,
                'category_id' => 4,
            ),

            array(
                'article_id' => 10,
                'category_id' => 4,
            ),

            array(
                'article_id' => 11,
                'category_id' => 9,
            ),

            array(
                'article_id' => 12,
                'category_id' => 9,
            ),

            array(
                'article_id' => 13,
                'category_id' => 9,
            ),
            /*Technicke dvere clanky*/
            array(
                'article_id' => 14,
                'category_id' => 7,
            ),

            array(
                'article_id' => 15,
                'category_id' => 7,
            ),

            array(
                'article_id' => 16,
                'category_id' => 7,
            ),

            array(
                'article_id' => 17,
                'category_id' => 7,
            ),
            /*Vonkajsie vstupne dvere clanky*/
            array(
                'article_id' => 18,
                'category_id' => 6,
            ),

            array(
                'article_id' => 19,
                'category_id' => 6,
            ),

            array(
                'article_id' => 20,
                'category_id' => 6,
            ),
            /*Interierove dvere clanky*/

            array(
                'article_id' => 21,
                'category_id' => 5,
            ),

            array(
                'article_id' => 22,
                'category_id' => 5,
            ),

            array(
                'article_id' => 23,
                'category_id' => 5,
            ),

            array(
                'article_id' => 24,
                'category_id' => 5,
            ),

            array(
                'article_id' => 25,
                'category_id' => 5,
            )
        ];

        $table = $this->table('category_article');
        $table->insert($data)->save();
    }
}
