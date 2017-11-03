<?php

use Phinx\Seed\AbstractSeed;

class ArticleSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            /*Clanky pod podlahami*/
            array(
                'title' => 'PVC podlahy',
                'content' => 'Takisto sa môžete pozrieť na PVC podlahy s imitáciou dubu, borovice, jelše, čerešne...  Vďaka profesionálnemu kvalitnému spracovaniu sú tieto podlahy príjemné na dotyk, údržbu a na pohľad sú nerozoznateľné od dreva. ',
                'slug' => 'pvc-podlahy',

            ),

            array(
                'title' => 'Vinylové podlahy',
                'content' => 'Takisto sa môžete pozrieť na vinylové podlahy s imitáciou dubu, borovice, jelše, čerešne...  Vďaka profesionálnemu kvalitnému spracovaniu sú tieto podlahy príjemné na dotyk, údržbu a na pohľad sú nerozoznateľné od dreva. ',
                'slug' => 'vinylove-podlahy',

            ),

            array(
                'title' => 'Drevené podlahy',
                'content' => 'V ponuke máme 15 rôznych typov podláh z vysokokvalitného dreveného materiálu, akými sú buk, smrek, jaseň... Tieto kvalitné podlahy z dreva sú veľmi obľúbené pre svoje pocitové vlastnosti, čo sa týka spracovania, údržby, vône a celkovej atmosféry, ktorú kvalitná drevená podlaha dodáva cez priamy kontakt človeka s prírodou.  ',
                'slug' => 'drevene-podlahy'
            ),

            array(
                'title' => 'Laminátové podlahy',
                'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ',
                'slug' => 'laminatove-podlahy'
            ),
            /* Prislusenstvo podkategoria */
            array(
                'title' => 'Svetlíky',
                'content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus ',
                'slug' => 'svetliky'
            ),

            array(
                'title' => 'Zárubne',
                'content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus',
                'slug' => 'zarubne'
            ),

            array(
                'title' => 'Posuvné systémy',
                'content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus ',
                'slug' => 'posuvne-systemy'
            ),

            /*Osobitne clanky*/
            array(
                'title' => 'O nás',
                'description' => 'Vitajte na našej stránke, kde si môžete pozrieť komplet celý sortiment ohľadom PODLÁH, DVERÍ, ZÁRUBNÍ. Takisto môžete vidieť naše vytvorené práce, ktoré sme u našich klientov už realizovali. A ani to nie je všetko. Nechajte sa inšpirovať a kľudne nás kontaktujte. Lebo kvalitné firmy a obchodníci sa stále vracajú veľmi radi k osobnému stretnutiu s Vami - našimi spokojnými zákazníkmi!',
                'content' => '<h2>HISTÓRIA</h2><p class="description"> Možno ste si už položili otázku (keďže konkurencia je veľká), prečo práve my? Naša rodinná firma, ktorú sme založili v roku 2005, sa neustále rozrastá len vďaka Vám a vďaka klientom, ktorí sa k nám vždy radi vracajú. Očakávajú od nás to, na čom sme túto firmu postavili. A to je osobný prístup, individuálne riešenia, vieme určite klienta nasmerovať a dokonca odporučiť mu aj odborníkov, aby svoj domov mal taký, aký si predstavoval. A ak to o nás budú ďalej rozširovať, tak je to len znak toho, že ideme dobrou cestou a spolu s Vami, spokojnými zákazníkmi, obchodnými partnermi aj priatelmi.</p>',
                'slug' => 'o-nas'
            ),

            array(
                'title' => 'AKO SI SPRÁVNE VYBRAŤ PODLAHU DO BYTU, DOMU, KANCELÁRIE?',
                'description' => 'Ešte kým sa správne rozhodnete, objednáte a zakúpite si niekoľko štvorcových metrov Vašej podlahy, zastavte sa, prosím, u nás a príďte si pozrieť s Vaším partnerom, partnerkou, známym vzorky podláh. Alebo Vám pár z nich priamo požičiame domov. Pretože tieto vzorky môžu pôsobiť úplne iným dojmom v predajni, kde je viac umelého svetla a iným dojmom u Vás doma, kde si ich viete umiestniť aj k Vášmu nábytku alebo aj k spomínanému dopadu priameho slnečného svetla. Nakoniec finálny výsledok bude určite zaručený a Vy budete so svojím výberom a naším odporúčaním spokojný.',
                'content' => 'Ešte kým sa správne rozhodnete, objednáte a zakúpite si niekoľko štvorcových metrov Vašej podlahy, zastavte sa, prosím, u nás a príďte si pozrieť s Vaším partnerom, partnerkou, známym vzorky podláh. Alebo Vám pár z nich priamo požičiame domov. Pretože tieto vzorky môžu pôsobiť úplne iným dojmom v predajni, kde je viac umelého svetla a iným dojmom u Vás doma, kde si ich viete umiestniť aj k Vášmu nábytku alebo aj k spomínanému dopadu priameho slnečného svetla. Nakoniec finálny výsledok bude určite zaručený a Vy budete so svojím výberom a naším odporúčaním spokojný.',
                'slug' => 'ako-si-spravne-vybrat-podlahu-do-bytu-domu-kancelarie',
            ),

            array(
                'title' => 'AKO SI SPRÁVNE VYBRAŤ DVERE DO DOMU, BYTU',
                'description' => 'Dvere si môžete dať vyrobiť u stolára na mieru alebo si u predajcu zakúpiť určitú fabrickú značku dverí, čo je v konečnom dôsledku oveľa nákladnejšie – keďže práve u nás máme široký sortiment už vyrobených dverí, aby ste si ich vedeli aj vybrať, vyskúšať či sa ich dotknúť a ucítiť ich priamo Vašou rukou. Takisto dvere z našich katalógov sú už väčšinou vyrobené a tým Vám ušetríme čas s ich výrobou alebo nákladmi na dovoz a následne prepravu.',
                'content' => 'Prečo prísť práve k nám
                 Dvere si môžete dať vyrobiť u stolára na mieru alebo si u predajcu zakúpiť určitú fabrickú značku dverí, čo je v konečnom dôsledku oveľa nákladnejšie – keďže práve u nás máme široký sortiment už vyrobených dverí, aby ste si ich vedeli aj vybrať, vyskúšať či sa ich dotknúť a ucítiť ich priamo Vašou rukou. Takisto dvere z našich katalógov sú už väčšinou vyrobené a tým Vám ušetríme čas s ich výrobou alebo nákladmi na dovoz a následne prepravu.',
                'slug' => 'ako-si-spravne-vybrat-dvere-do-domu-bytu',
            ),

            array(
                'title' => 'Svet podláh',
                'description' => 'button',
                'content' => 'svetpodlah.sk',
                'slug' => 'svet-podlah'
            ),

            array(
                'title' => 'Europarket',
                'description' => 'button',
                'content' => 'europarket.sk',
                'slug' => 'europarket'
            ),

            array(
                'title' => 'Floor experts',
                'description' => 'button',
                'content' => 'floor-experts.sk/katalogy',
                'slug' => 'floor-experts'
            ),
            /*Technicke dvere podkategoria - clanky*/
            array(
                'title' => 'Protipožiarné dvere',
                'content' => 'Kvalitné protipožiarne dvere vedia zabezpečiť a ochrániť váš domov, firmu, obchod, zdravie aj majetok. Vyberte si pre svoj účel len tie kvalitné a otestované protipožiarne dvere. Takisto Vám vieme zabezpečiť protipožiarne dvere z rôznych materiálov, povrchových úprav, aby aj tieto dvere vedeli zútulniť Váš domov alebo firmu a následne ho aj zabezpečiť. Tieto dvere Vám poskytnú ochranu nielen pred živlom, akým je oheň, ale môžete si ich doplniť aj o dymotesnosť a zvukovú izoláciu. Protipožiarne dvere je možné použiť aj ako vstupné dvere do bytu, sú ale oveľa mohutnejšie ako štandardné vnútorné dvere, perto oveľa lepšie vedia odolať v prípade pokusu o vniknutie do Vášho súkromia. Jednak pre ešte väčšiu ochranu sa dajú protipožiarne dvere zabezpečiť priamo otestované proti vniknutiu a vlámaniu, označené ako B2 či B3 (čím vyššie číslo bezpečnostnej triedy, tým vyššia zaistená ochrana).',
                'slug' => 'protipoziarne-dvere'
            ),

            array(
                'title' => 'Bezpečnostné dvere',
                'content' => 'Bezpečnostné dvere sú vhodné naozaj pre každého. Sú cenovo dostupné dvere a spojené s bezpečnostnou zárubňou, tepelnou a zvukovou izoláciou. Vstupné dvere do Vášho domu alebo bytu sú vhodné na zabezpečenie vášho bývania za ceny, ktoré nezaťažia rodinný rozpočet.',
                'slug' => 'bezpecnostne-dvere'
            ),

            array(
                'title' => 'Akustické dvere',
                'content' => 'Každý ľudský organizmus reaguje inak na intenzitu hluku. Je vedecky dokázané, že nadmerný hluk je pri jeho vnímaní naozaj veľmi stresujúci a môže spôsobovať aj zdravotné problémy. V tejto kategórii Vám chceme predstaviť akustické dvere, ktoré sú určené pre zníženie alebo utlmenie nežiaduceho hluku cez dvere. Zvukovo-izolačné dvere pomáhajú dosiahnuť vysoký komfort priestoru so znížením hluku. Protihlukové, akustické dvere sú vyrábané na mieru podľa požiadaviek zákazníka a ktoré obsahujú špeciálnu viacvrstvovú akustickú výplň. Rám dverí je vyrábaný z masívneho viacvrstvového lepeného dreva.',
                'slug' => 'akusticke-dvere'
            ),

            array(
                'title' => 'Oceľové dvere',
                'content' => 'Oceľové dvere sú stabilné pri veľkom zaťažení poveternostnými vplyvmi, sú odolné voči prívalovému dažďu, nepriepustné, majú kvalitnú zvukovú i tepelnú izoláciu. Životnosť oceľových dverí je niekoľkokrát zvýšená, ako aj koeficient prestupu tepla je o mnoho stupňov lepší. V porovnaní s plastovými alebo hliníkovými dverami sú dvere s oceľovou konštrukciou hlavne z bezpečnostných dôvodov lepšou voľbou.',
                'slug' => 'ocelove-dvere'
            ),

            /*Vonkajsie vstupne dvere podkategoria - clanky*/
            array(
                'title' => 'Drevené dvere',
                'content' => 'Tradičné alebo moderné, biely lak alebo svetlý buk, so sklenenými doplnkami alebo vyrobené z ušľachtilej ocele – ponúka Vám presne také drevené interiérové dvere, ktoré si určite obľúbite vo Vašom bývaní. Vnútorné drevené dvere zaujmú vysoko-kvalitným vzhľadom a výbornou kvalitou. Budú Vás tešiť veľmi dlho a pre Váš domov vytvoria prírodný vzhľad.',
                'slug' => 'drevene-dvere'
            ),

            array(
                'title' => 'Oceľové dvere',
                'content' => 'Oceľové dvere sú stabilné pri veľkom zaťažení poveternostnými vplyvmi, sú odolné voči prívalovému dažďu, nepriepustné, majú kvalitnú zvukovú i tepelnú izoláciu. Životnosť oceľových dverí je niekoľkokrát zvýšená, ako aj koeficient prestupu tepla je o mnoho stupňov lepší. V porovnaní s plastovými alebo hliníkovými dverami sú dvere s oceľovou konštrukciou hlavne z bezpečnostných dôvodov lepšou voľbou.',
                'slug' => 'ocelove-dvere'
            ),

            array(
                'title' => 'Energeticky úsporné dvere',
                'content' => 'Okná a dvere sú "podpisom" každého domu. Kvalitne zakomponované do stavebného objektu vypovedajú o majiteľovi a zvyšujú celkový dojem kompletnej stavby. Kvalita vnútorných dverí vplýva na komfort života v celom interiéri bývania, pretože je zrejmé, že vytvára priestor, ktorým môže, ale nemusí unikať najviac tepla a peňazí na vykurovanie. A hlavne - výmena dverí za nové, energeticky úsporné dvere, umožňuje minimalizovať straty tepla až o 35 %.',
                'slug' => 'energeticky-usporne-dvere'
            ),
            /*Interierove dvere podkategoria - clanky*/

            array(
                'title' => 'Rámové dvere',
                'content' => 'Rámové interiérové dvere sú jedničkou v súčasnej výrobe dverí. Dverné krídlo sa skládá z HDF profilov, každý rámový diel je zvlášť obalený laminátovým povrchom. Opláštenie každého dielu zvlášť zaručuje skryté spoje povrchov, vonkajšie hrany dverí sú bez viditeľných spojov a medzier. Konštrukcia rámových dverí je unikátna tým, že v presklených modeloch nie je treba používať orámovanie. Sklo u rámových dverí je zapustené priamo do HDF hranolu, vďaka čomu celá plocha dverného krídla neobsahuje žiadne vystupujúce rámčeky, maximálna hrúbka dverného krídla je 4 cm. ',
                'slug' => 'ramove-dvere'
            ),

            array(
                'title' => 'Skladacie dvere',
                'content' => 'Skladacie dvere sú vhodnou alternatívou, ak obyčajné dvere zaberajú veľa miesta, respektíve nie je možné umiestniť posuvné dvere. Pri ich otvorení dôjde k zloženiu dverí na dve rovnaké polovice a zasunutiu k jednej strane zárubne. Týmto sa priechod zmenší aj o 8,5 cm. Kovanie týchto dverí je skryté, takže pri zatvorených dverách nie je závesy vôbec vidno.',
                'slug' => 'skladacie-dvere'
            ),

            array(
                'title' => 'Voštinové dvere',
                'content' => 'Pri tomto type riešenia je dverný rám vyrobený z borovicových profilov a výplň dverí pozostáva z voštiny. Rám s voštinou je z obidvoch strán opláštený HDF doskou. Dvere s touoto výplňou sú zaujímavým odporúčaním pre zákazníkov, ktorí hľadajú nižšiu cenu, avšak nechcú to mať na úkor kvality výrobku. Voštinovú výplň môžete nájsť v ponuke dverí so syntetickým povrchom (lak, fólia, laminát). Určite vám radi poradíme, aké dvere s voštinovou výplňou splnia požadované služby a kde je radšej lepšie si priplatiť za výplň z dutinkovej drevotriesky.',
                'slug' => 'vostinove-dvere'
            ),

            array(
                'title' => 'Posuvné dvere',
                'content' => 'Máte dojem, že potrebujete vo Vašom bývaní viac priestoru, chcete niečo zvláštne alebo skrátka ste fanúšikom kvalitných moderných prvkov? Posuvné dvere sú ideálnou voľbou pre všetky neštandardné situácie, ktoré sa môžu objaviť v malých bytoch, ale aj vo väčších priestoroch, kde sa klasické dvere na pántoch z akýchkoľvek príčin nehodia.',
                'slug' => 'posuvne-dvere'
            ),

            array(
                'title' => 'Sklenené dvere',
                'content' => 'Sklenené dvere se stávajú hitom interiérového dizajnu. Sú elegantné a pôsobia veľmi luxusným dojmom. Sú takisto veľmi žiadané nielen kvôli vzhľadu, ale aj pre vlastnosti, ktoré sklenené dvere odlišujú od všetkých ostatných. Týmito vlastnosťami sú priesvitnosť a priehľadnosť. Sklenené dvere priestory Vášho bytu či domu krásne rozjasnia prirodzeným vonkajším svetlom.',
                'slug' => 'sklenene-dvere'
            )

        ];

        $table = $this->table('articles');
        $table->insert($data)->save();
    }
}
