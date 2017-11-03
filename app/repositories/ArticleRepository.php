<?php

namespace App\Repositories;


final class ArticleRepository extends BaseRepository
{

    /** {@inheritdoc} */
    protected function getTableName(): string
    {
        return 'articles';
    }


    /*public function getInsertArticleForm($form, $values)
    {
        $images = $values->image;

        $article = $this->getTable('article')->insert([
            'title' => $values->title,
            'content' => $values->content
        ]);

        if ($images != null) {
            foreach ($images as $image){
                //dump($image); exit;
                $image->move(IMAGES_PATH . "/" . $image->name);
                $image_id =  $this->getTable('image')->insert([
                    'name' => $image->name,
                    'alt' => $values->alt,
                    'size' => $image->size . " bytes"
                ]);
                $this->getTable('article_image')->insert([
                    'article_id' => $article->id,
                    'image_id' => $image_id->id
                ]);
            }
        }
        if ($values->choice > 0) {
            $this->getTable('cat_art')->insert([
                'cat_id' => $values->choice,
                'art_id' => $article->id
            ]);
        }
    }

    public function getUpdateArticle($form, $values)
    {
        $article_id = $values->choice;
        if ($values->title  != null) {
            $article = $this->getTable('article')->get($values->choice)->update([
                'title' => $values->title
            ]);
        }
        if ($values->content != null){
            $this->getTable('article')->get($values->choice)->update([
                'content' => $values->content
            ]);
        }
        $images = $values->image;
        $name = $this->getTable('image')->fetchPairs( 'name');
        if ($images != null) {
            foreach ($images as $image){
                if ($image->name != $name) {
                    $image->move(IMAGES_PATH . "/" . $image->name);
                    $image_id = $this->getTable('image')->insert([
                        'name' => $image->name,
                        'alt' => $values->alt,
                        'size' => $image->size . " bytes"
                    ]);
                    $this->getTable('article_image')->insert([
                        'article_id' => $article_id,
                        'image_id' => $image_id->id
                    ]);

                }

            }


        }


    }*/
    /*public function getArticleImage()
    {

        $article_id = $this->db->table('article')->fetch();
        $image_id = $this->db->table('article')->fetch()->related('article_image');
        $articles_arr = ($article_id);
        foreach ($article_id as $article){
            $article->title;
        }

        dump($article); exit;

    }*/
}