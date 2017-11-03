<?php

use Phinx\Seed\AbstractSeed;

class BCategorySeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            array(
                'title' => 'Najvyššia kategória',
                'content' => 'Top',
                'slug' => 'najvyssia-kategoria',
                'status' => 'hidden',
                'parent_id' => null
            ),
            array(
                'title' => 'Podlahy',
                'content' => 'Elegantné a nadčasové dekorácie. V tejto časti by sme Vás radi chceli inšpirovať širokou kolekciou rôznych podláh, ktoré sú určené tak do kancelárskych priestorov ako aj do krásneho moderného alebo konzervatívneho domáceho interiéru. ',
                'slug' => 'podlahy',
                'parent_id' => 1
            ),
            array(
                'title' => 'Dvere',
                'content' => 'Presne tak, ako sa hovorí, že "oči sú dverami do duše", tak isto je to aj u dverí. Otvárajú a ponúkajú nám na prvý pohľad bránu do nášho domova. Niekedy dokonca nás môžu naviesť na pocit, aký príbeh sa za takými alebo onakými dverami môže v interiéri odohrávať. Je to takmer ako prvý dojem, ktorý je unikátny a je len raz. Presne tak isto aj naše dvere Vás, veríme, že očaria natoľko, aby ste ich právom považovali za nemenej dôležitý fakt pri vytváraní Vášho domova alebo pobytu v práci. Môžete sa pohrať s typom, farebnosťou ako aj so spomínaným prvým dojmom. ',
                'slug' => 'dvere',
                'parent_id' => 1
            ),
            array(
                'title' => 'Poradňa',
                'content' => 'V tejto časti sa môžete inšpirovať vhodnými a odskúšanými postupmi, ktoré sme doteraz realizovali. Samozrejme privítame hlavne osobný kontakt, kde Vám budeme vedieť zodpovedať všetky Vaše ďalšie otázky...',
                'slug' => 'poradna',
                'parent_id' => null
            ),

            array(
                'title' => 'Interiérové dvere',
                'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.  ',
                'slug' => 'interierove-dvere',
                'parent_id' => 3
            ),
           array(
                'title' => 'Vonkajšie vstupné dvere',
                'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ',
                'slug' => 'vonkajsie-vstupne-dvere',
                'parent_id' => 3
           ),
            array(
                'title' => 'Technické dvere',
                'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. ',
                'slug' => 'technicke-dvere',
                'parent_id' => 3
            ),
            array(
                'title' => 'Príslušenstvo',
                'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ',
                'slug' => 'prislusenstvo',
                'parent_id' => 3
            ),

            array(
                'title' => 'Vyrobcovia a katalogy',
                'content' => 'Vyrobcovia-a-katalogy',
                'slug' => 'vyrobcovia-a-katalogy',
                'parent_id' => null
            )

        ];

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
