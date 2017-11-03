-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 11.Sep 2017, 12:38
-- Verzia serveru: 10.1.25-MariaDB
-- Verzia PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `podlahyadvere_test`
--
CREATE DATABASE IF NOT EXISTS `podlahyadvere_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `podlahyadvere_test`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `article_image`
--

CREATE TABLE `article_image` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) NOT NULL DEFAULT 'show',
  `slug` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `content`, `created_at`, `updated_at`, `deleted_at`, `status`, `slug`, `image_id`) VALUES
(1, 'PVC podlahy', '', 'Takisto sa môžete pozrieť na PVC podlahy s imitáciou dubu, borovice, jelše, čerešne...  Vďaka profesionálnemu kvalitnému spracovaniu sú tieto podlahy príjemné na dotyk, údržbu a na pohľad sú nerozoznateľné od dreva. ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:54', 'show', 'pvc-podlahy', NULL),
(2, 'Vinylové podlahy', '', 'Takisto sa môžete pozrieť na vinylové podlahy s imitáciou dubu, borovice, jelše, čerešne...  Vďaka profesionálnemu kvalitnému spracovaniu sú tieto podlahy príjemné na dotyk, údržbu a na pohľad sú nerozoznateľné od dreva. ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:54', 'show', 'vinylove-podlahy', NULL),
(3, 'Drevené podlahy', '', 'V ponuke máme 15 rôznych typov podláh z vysokokvalitného dreveného materiálu, akými sú buk, smrek, jaseň... Tieto kvalitné podlahy z dreva sú veľmi obľúbené pre svoje pocitové vlastnosti, čo sa týka spracovania, údržby, vône a celkovej atmosféry, ktorú kvalitná drevená podlaha dodáva cez priamy kontakt človeka s prírodou.  ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:54', 'show', 'drevene-podlahy', NULL),
(4, 'Laminátové podlahy', '', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'laminatove-podlahy', NULL),
(5, 'Svetlíky', '', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'svetliky', NULL),
(6, 'Zárubne', '', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'zarubne', NULL),
(7, 'Posuvné systémy', '', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'posuvne-systemy', NULL),
(8, 'O nás', 'Vitajte na našej stránke, kde si môžete pozrieť komplet celý sortiment ohľadom PODLÁH, DVERÍ, ZÁRUBNÍ. Takisto môžete vidieť naše vytvorené práce, ktoré sme u našich klientov už realizovali. A ani to nie je všetko. Nechajte sa inšpirovať a kľudne nás kontaktujte. Lebo kvalitné firmy a obchodníci sa stále vracajú veľmi radi k osobnému stretnutiu s Vami - našimi spokojnými zákazníkmi!', '<h2>HISTÓRIA</h2><p class=\"description\"> Možno ste si už položili otázku (keďže konkurencia je veľká), prečo práve my? Naša rodinná firma, ktorú sme založili v roku 2005, sa neustále rozrastá len vďaka Vám a vďaka klientom, ktorí sa k nám vždy radi vracajú. Očakávajú od nás to, na čom sme túto firmu postavili. A to je osobný prístup, individuálne riešenia, vieme určite klienta nasmerovať a dokonca odporučiť mu aj odborníkov, aby svoj domov mal taký, aký si predstavoval. A ak to o nás budú ďalej rozširovať, tak je to len znak toho, že ideme dobrou cestou a spolu s Vami, spokojnými zákazníkmi, obchodnými partnermi aj priatelmi.</p>', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'o-nas', NULL),
(9, 'AKO SI SPRÁVNE VYBRAŤ PODLAHU DO BYTU, DOMU, KANCELÁRIE?', 'Ešte kým sa správne rozhodnete, objednáte a zakúpite si niekoľko štvorcových metrov Vašej podlahy, zastavte sa, prosím, u nás a príďte si pozrieť s Vaším partnerom, partnerkou, známym vzorky podláh. Alebo Vám pár z nich priamo požičiame domov. Pretože tieto vzorky môžu pôsobiť úplne iným dojmom v predajni, kde je viac umelého svetla a iným dojmom u Vás doma, kde si ich viete umiestniť aj k Vášmu nábytku alebo aj k spomínanému dopadu priameho slnečného svetla. Nakoniec finálny výsledok bude určite zaručený a Vy budete so svojím výberom a naším odporúčaním spokojný.', 'Ešte kým sa správne rozhodnete, objednáte a zakúpite si niekoľko štvorcových metrov Vašej podlahy, zastavte sa, prosím, u nás a príďte si pozrieť s Vaším partnerom, partnerkou, známym vzorky podláh. Alebo Vám pár z nich priamo požičiame domov. Pretože tieto vzorky môžu pôsobiť úplne iným dojmom v predajni, kde je viac umelého svetla a iným dojmom u Vás doma, kde si ich viete umiestniť aj k Vášmu nábytku alebo aj k spomínanému dopadu priameho slnečného svetla. Nakoniec finálny výsledok bude určite zaručený a Vy budete so svojím výberom a naším odporúčaním spokojný.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'ako-si-spravne-vybrat-podlahu-do-bytu-domu-kancelarie', NULL),
(10, 'AKO SI SPRÁVNE VYBRAŤ DVERE DO DOMU, BYTU', 'Dvere si môžete dať vyrobiť u stolára na mieru alebo si u predajcu zakúpiť určitú fabrickú značku dverí, čo je v konečnom dôsledku oveľa nákladnejšie – keďže práve u nás máme široký sortiment už vyrobených dverí, aby ste si ich vedeli aj vybrať, vyskúšať či sa ich dotknúť a ucítiť ich priamo Vašou rukou. Takisto dvere z našich katalógov sú už väčšinou vyrobené a tým Vám ušetríme čas s ich výrobou alebo nákladmi na dovoz a následne prepravu.', 'Prečo prísť práve k nám\r\n                 Dvere si môžete dať vyrobiť u stolára na mieru alebo si u predajcu zakúpiť určitú fabrickú značku dverí, čo je v konečnom dôsledku oveľa nákladnejšie – keďže práve u nás máme široký sortiment už vyrobených dverí, aby ste si ich vedeli aj vybrať, vyskúšať či sa ich dotknúť a ucítiť ich priamo Vašou rukou. Takisto dvere z našich katalógov sú už väčšinou vyrobené a tým Vám ušetríme čas s ich výrobou alebo nákladmi na dovoz a následne prepravu.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'ako-si-spravne-vybrat-dvere-do-domu-bytu', NULL),
(11, 'Svet podláh', 'button', 'svetpodlah.sk', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:50', 'show', 'svet-podlah', NULL),
(12, 'Europarket', 'button', 'europarket.sk', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:49', 'show', 'europarket', NULL),
(13, 'Floor experts', 'button', 'floor-experts.sk/katalogy', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:49', 'show', 'floor-experts', NULL),
(14, 'Protipožiarné dvere', '', 'Kvalitné protipožiarne dvere vedia zabezpečiť a ochrániť váš domov, firmu, obchod, zdravie aj majetok. Vyberte si pre svoj účel len tie kvalitné a otestované protipožiarne dvere. Takisto Vám vieme zabezpečiť protipožiarne dvere z rôznych materiálov, povrchových úprav, aby aj tieto dvere vedeli zútulniť Váš domov alebo firmu a následne ho aj zabezpečiť. Tieto dvere Vám poskytnú ochranu nielen pred živlom, akým je oheň, ale môžete si ich doplniť aj o dymotesnosť a zvukovú izoláciu. Protipožiarne dvere je možné použiť aj ako vstupné dvere do bytu, sú ale oveľa mohutnejšie ako štandardné vnútorné dvere, perto oveľa lepšie vedia odolať v prípade pokusu o vniknutie do Vášho súkromia. Jednak pre ešte väčšiu ochranu sa dajú protipožiarne dvere zabezpečiť priamo otestované proti vniknutiu a vlámaniu, označené ako B2 či B3 (čím vyššie číslo bezpečnostnej triedy, tým vyššia zaistená ochrana).', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'protipoziarne-dvere', NULL),
(15, 'Bezpečnostné dvere', '', 'Bezpečnostné dvere sú vhodné naozaj pre každého. Sú cenovo dostupné dvere a spojené s bezpečnostnou zárubňou, tepelnou a zvukovou izoláciou. Vstupné dvere do Vášho domu alebo bytu sú vhodné na zabezpečenie vášho bývania za ceny, ktoré nezaťažia rodinný rozpočet.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'bezpecnostne-dvere', NULL),
(16, 'Akustické dvere', '', 'Každý ľudský organizmus reaguje inak na intenzitu hluku. Je vedecky dokázané, že nadmerný hluk je pri jeho vnímaní naozaj veľmi stresujúci a môže spôsobovať aj zdravotné problémy. V tejto kategórii Vám chceme predstaviť akustické dvere, ktoré sú určené pre zníženie alebo utlmenie nežiaduceho hluku cez dvere. Zvukovo-izolačné dvere pomáhajú dosiahnuť vysoký komfort priestoru so znížením hluku. Protihlukové, akustické dvere sú vyrábané na mieru podľa požiadaviek zákazníka a ktoré obsahujú špeciálnu viacvrstvovú akustickú výplň. Rám dverí je vyrábaný z masívneho viacvrstvového lepeného dreva.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'akusticke-dvere', NULL),
(17, 'Oceľové dvere', '', 'Oceľové dvere sú stabilné pri veľkom zaťažení poveternostnými vplyvmi, sú odolné voči prívalovému dažďu, nepriepustné, majú kvalitnú zvukovú i tepelnú izoláciu. Životnosť oceľových dverí je niekoľkokrát zvýšená, ako aj koeficient prestupu tepla je o mnoho stupňov lepší. V porovnaní s plastovými alebo hliníkovými dverami sú dvere s oceľovou konštrukciou hlavne z bezpečnostných dôvodov lepšou voľbou.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'ocelove-dvere', NULL),
(18, 'Drevené dvere', '', 'Tradičné alebo moderné, biely lak alebo svetlý buk, so sklenenými doplnkami alebo vyrobené z ušľachtilej ocele – ponúka Vám presne také drevené interiérové dvere, ktoré si určite obľúbite vo Vašom bývaní. Vnútorné drevené dvere zaujmú vysoko-kvalitným vzhľadom a výbornou kvalitou. Budú Vás tešiť veľmi dlho a pre Váš domov vytvoria prírodný vzhľad.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'drevene-dvere', NULL),
(19, 'Oceľové dvere', '', 'Oceľové dvere sú stabilné pri veľkom zaťažení poveternostnými vplyvmi, sú odolné voči prívalovému dažďu, nepriepustné, majú kvalitnú zvukovú i tepelnú izoláciu. Životnosť oceľových dverí je niekoľkokrát zvýšená, ako aj koeficient prestupu tepla je o mnoho stupňov lepší. V porovnaní s plastovými alebo hliníkovými dverami sú dvere s oceľovou konštrukciou hlavne z bezpečnostných dôvodov lepšou voľbou.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'ocelove-dvere', NULL),
(20, 'Energeticky úsporné dvere', '', 'Okná a dvere sú \"podpisom\" každého domu. Kvalitne zakomponované do stavebného objektu vypovedajú o majiteľovi a zvyšujú celkový dojem kompletnej stavby. Kvalita vnútorných dverí vplýva na komfort života v celom interiéri bývania, pretože je zrejmé, že vytvára priestor, ktorým môže, ale nemusí unikať najviac tepla a peňazí na vykurovanie. A hlavne - výmena dverí za nové, energeticky úsporné dvere, umožňuje minimalizovať straty tepla až o 35 %.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'energeticky-usporne-dvere', NULL),
(21, 'Rámové dvere', '', 'Rámové interiérové dvere sú jedničkou v súčasnej výrobe dverí. Dverné krídlo sa skládá z HDF profilov, každý rámový diel je zvlášť obalený laminátovým povrchom. Opláštenie každého dielu zvlášť zaručuje skryté spoje povrchov, vonkajšie hrany dverí sú bez viditeľných spojov a medzier. Konštrukcia rámových dverí je unikátna tým, že v presklených modeloch nie je treba používať orámovanie. Sklo u rámových dverí je zapustené priamo do HDF hranolu, vďaka čomu celá plocha dverného krídla neobsahuje žiadne vystupujúce rámčeky, maximálna hrúbka dverného krídla je 4 cm. ', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'ramove-dvere', NULL),
(22, 'Skladacie dvere', '', 'Skladacie dvere sú vhodnou alternatívou, ak obyčajné dvere zaberajú veľa miesta, respektíve nie je možné umiestniť posuvné dvere. Pri ich otvorení dôjde k zloženiu dverí na dve rovnaké polovice a zasunutiu k jednej strane zárubne. Týmto sa priechod zmenší aj o 8,5 cm. Kovanie týchto dverí je skryté, takže pri zatvorených dverách nie je závesy vôbec vidno.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'skladacie-dvere', NULL),
(23, 'Voštinové dvere', '', 'Pri tomto type riešenia je dverný rám vyrobený z borovicových profilov a výplň dverí pozostáva z voštiny. Rám s voštinou je z obidvoch strán opláštený HDF doskou. Dvere s touoto výplňou sú zaujímavým odporúčaním pre zákazníkov, ktorí hľadajú nižšiu cenu, avšak nechcú to mať na úkor kvality výrobku. Voštinovú výplň môžete nájsť v ponuke dverí so syntetickým povrchom (lak, fólia, laminát). Určite vám radi poradíme, aké dvere s voštinovou výplňou splnia požadované služby a kde je radšej lepšie si priplatiť za výplň z dutinkovej drevotriesky.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:46', 'show', 'vostinove-dvere', NULL),
(24, 'Posuvné dvere', '', 'Máte dojem, že potrebujete vo Vašom bývaní viac priestoru, chcete niečo zvláštne alebo skrátka ste fanúšikom kvalitných moderných prvkov? Posuvné dvere sú ideálnou voľbou pre všetky neštandardné situácie, ktoré sa môžu objaviť v malých bytoch, ale aj vo väčších priestoroch, kde sa klasické dvere na pántoch z akýchkoľvek príčin nehodia.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:41', 'show', 'posuvne-dvere', NULL),
(25, 'Sklenené dvere', '', 'Sklenené dvere se stávajú hitom interiérového dizajnu. Sú elegantné a pôsobia veľmi luxusným dojmom. Sú takisto veľmi žiadané nielen kvôli vzhľadu, ale aj pre vlastnosti, ktoré sklenené dvere odlišujú od všetkých ostatných. Týmito vlastnosťami sú priesvitnosť a priehľadnosť. Sklenené dvere priestory Vášho bytu či domu krásne rozjasnia prirodzeným vonkajším svetlom.', '2017-09-07 09:10:26', NULL, '2017-09-11 10:35:41', 'show', 'sklenene-dvere', NULL),
(26, 'aaaa', '', 'aaaa', '2017-09-11 08:46:10', '2017-09-11 08:46:16', '2017-09-11 10:35:41', 'show', 'aaaa', NULL),
(27, 'asdfasfd', '', 'asdfasdffasd', '2017-09-11 08:47:01', '2017-09-11 08:47:05', '2017-09-11 10:35:41', 'show', 'fasdafsdf', NULL),
(28, 'aaaa', '', 'fsad', '2017-09-11 08:48:05', '2017-09-11 08:48:09', '2017-09-11 10:35:41', 'show', 'fsdfa', NULL),
(29, 'fasd', '', 'asdf', '2017-09-11 08:56:53', '2017-09-11 08:56:57', '2017-09-11 10:35:41', 'show', 'afsdd', NULL),
(30, 'aaaa', '', 'aaa', '2017-09-11 08:58:16', '2017-09-11 08:58:19', '2017-09-11 10:35:41', 'show', 'aaa', NULL),
(31, 'fdsaf', '', 'fasd', '2017-09-11 08:58:35', '2017-09-11 08:58:39', '2017-09-11 10:35:41', 'show', 'asdf', NULL),
(32, 'fasfasdfdsaf', '', 'asdfasdf', '2017-09-11 08:58:48', '2017-09-11 08:58:51', '2017-09-11 10:35:41', 'show', 'asdfa', NULL),
(33, 'fasdfsf', '', 'fasdasdfsdf', '2017-09-11 08:59:14', '2017-09-11 08:59:18', '2017-09-11 10:31:05', 'show', 'asdf', NULL),
(34, 'bbbb', '', 'bbbb', '2017-09-11 09:09:39', '2017-09-11 09:09:42', '2017-09-11 10:31:02', 'show', 'bbb', NULL),
(35, 'fffff', '', 'ffff', '2017-09-11 10:31:16', '2017-09-11 10:31:22', '2017-09-11 10:35:41', 'show', 'fffff', NULL),
(36, 'fasdfsf', '', '', '2017-09-11 10:34:30', '2017-09-11 10:34:34', '2017-09-11 10:35:35', 'show', 'fsdffsd', NULL),
(37, 'fasd', '', 'fasd', '2017-09-11 10:36:05', '2017-09-11 10:36:09', '2017-09-11 10:36:20', 'show', 'fasd', NULL),
(38, 'fasdfas', '', 'fasdfs', '2017-09-11 10:36:28', '2017-09-11 10:36:32', '0000-00-00 00:00:00', 'show', 'fasdfas', NULL);

--
-- Spúšťače `articles`
--
DELIMITER $$
CREATE TRIGGER `articles_count` BEFORE INSERT ON `articles` FOR EACH ROW BEGIN
    SET @dataCount = (SELECT COUNT(id) FROM articles WHERE deleted_at = '0000-00-00 00:00:00');

    IF(EXISTS(SELECT * FROM system_settings WHERE name = 'articles')) THEN
      UPDATE system_settings SET value = @dataCount + 1 WHERE name = 'articles';
    ELSE
      INSERT INTO system_settings (name, value) VALUE ('articles', 1);
    END IF;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) NOT NULL DEFAULT 'show',
  `slug` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `categories`
--

INSERT INTO `categories` (`id`, `title`, `content`, `created_at`, `updated_at`, `deleted_at`, `status`, `slug`, `parent_id`, `image_id`) VALUES
(1, 'Najvyššia kategória', 'Top', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'hidden', 'najvyssia-kategoria', NULL, NULL),
(2, 'Podlahy', 'Elegantné a nadčasové dekorácie. V tejto časti by sme Vás radi chceli inšpirovať širokou kolekciou rôznych podláh, ktoré sú určené tak do kancelárskych priestorov ako aj do krásneho moderného alebo konzervatívneho domáceho interiéru. ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'podlahy', 1, NULL),
(3, 'Dvere', 'Presne tak, ako sa hovorí, že \"oči sú dverami do duše\", tak isto je to aj u dverí. Otvárajú a ponúkajú nám na prvý pohľad bránu do nášho domova. Niekedy dokonca nás môžu naviesť na pocit, aký príbeh sa za takými alebo onakými dverami môže v interiéri odohrávať. Je to takmer ako prvý dojem, ktorý je unikátny a je len raz. Presne tak isto aj naše dvere Vás, veríme, že očaria natoľko, aby ste ich právom považovali za nemenej dôležitý fakt pri vytváraní Vášho domova alebo pobytu v práci. Môžete sa pohrať s typom, farebnosťou ako aj so spomínaným prvým dojmom. ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'dvere', 1, NULL),
(4, 'Poradňa', 'V tejto časti sa môžete inšpirovať vhodnými a odskúšanými postupmi, ktoré sme doteraz realizovali. Samozrejme privítame hlavne osobný kontakt, kde Vám budeme vedieť zodpovedať všetky Vaše ďalšie otázky...', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'poradna', NULL, NULL),
(5, 'Interiérové dvere', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.  ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'interierove-dvere', 3, NULL),
(6, 'Vonkajšie vstupné dvere', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'vonkajsie-vstupne-dvere', 3, NULL),
(7, 'Technické dvere', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'technicke-dvere', 3, NULL),
(8, 'Príslušenstvo', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'prislusenstvo', 3, NULL),
(9, 'Vyrobcovia a katalogy', 'Vyrobcovia-a-katalogy', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00', 'show', 'vyrobcovia-a-katalogy', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `category_article`
--

CREATE TABLE `category_article` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `category_article`
--

INSERT INTO `category_article` (`id`, `article_id`, `category_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 8),
(6, 6, 8),
(7, 7, 8),
(8, 9, 4),
(9, 10, 4),
(10, 11, 9),
(11, 12, 9),
(12, 13, 9),
(13, 14, 7),
(14, 15, 7),
(15, 16, 7),
(16, 17, 7),
(17, 18, 6),
(18, 19, 6),
(19, 20, 6),
(20, 21, 5),
(21, 22, 5),
(22, 23, 5),
(23, 24, 5),
(24, 25, 5);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `category_image`
--

CREATE TABLE `category_image` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `contact_image`
--

CREATE TABLE `contact_image` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `title`, `value`, `parent_id`, `created_at`, `updated_at`, `deleted_at`, `image_id`) VALUES
(1, 'predajna1', 'Predajna', 'Podlahové štúdio', NULL, '2017-09-07 09:10:26', NULL, NULL, NULL),
(2, 'predajna2', 'Predajna', 'Areál FK Stavebniny', NULL, '2017-09-07 09:10:26', NULL, NULL, NULL),
(3, 'tel1', 'Telefón', '+421907479900', 1, '2017-09-07 09:10:26', NULL, NULL, NULL),
(4, 'tel2', 'Telefón', '0907147102', 2, '2017-09-07 09:10:26', NULL, NULL, NULL),
(5, 'email', 'Email', 'info@podlahyadvere.sk', 1, '2017-09-07 09:10:26', NULL, NULL, NULL),
(6, 'adresa1', 'Adresa', 'Partizánska 6', 1, '2017-09-07 09:10:26', NULL, NULL, NULL),
(7, 'adresa2', 'Adresa', 'Duklianska 12', 2, '2017-09-07 09:10:26', NULL, NULL, NULL),
(8, 'mesto', 'Mesto', '085 01 Bardejov', 1, '2017-09-07 09:10:26', NULL, NULL, NULL),
(9, 'obrazok1', 'Obrázok', NULL, 1, '2017-09-07 09:10:26', NULL, NULL, NULL),
(10, 'obrazok2', 'Obrázok', NULL, 2, '2017-09-07 09:10:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alt` text,
  `description` text,
  `size` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `path` text NOT NULL,
  `extension` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `special` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `parent_id`, `special`) VALUES
(1, 'Úvod', '/', NULL, 0),
(2, 'O nás', '/clanok/o-nas', NULL, 0),
(3, 'Kategórie', '#', NULL, 1),
(4, 'Poradňa', '/kategoria/poradna', NULL, 0),
(5, 'Kontakt', '/kontakt', NULL, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `message` text,
  `doors` varchar(255) DEFAULT NULL,
  `floors` varchar(255) DEFAULT NULL,
  `doors_quantity` int(11) DEFAULT NULL,
  `floors_quantity` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `order`
--

INSERT INTO `order` (`id`, `name`, `email`, `phone`, `city`, `message`, `doors`, `floors`, `doors_quantity`, `floors_quantity`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Peter Pisarcik', 'peter.p123321@gmail.com', '0949 418 926', 'Bardejov', 'Zdravim, chcem si objednat dvere', NULL, NULL, NULL, NULL, 'waiting', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00'),
(2, 'David Durco', 'kich182@icloud.com', '0950 432 329', 'Bardejov', 'Zdravim, chcem si objednat podlahy', NULL, NULL, NULL, NULL, 'waiting', '2017-09-07 09:10:26', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20170319122113, 'CreateArticleTable', '2017-09-07 09:10:06', '2017-09-07 09:10:06', 0),
(20170319141227, 'CreateCategoryTable', '2017-09-07 09:10:06', '2017-09-07 09:10:07', 0),
(20170319141418, 'CreateCategoryArticleTable', '2017-09-07 09:10:07', '2017-09-07 09:10:07', 0),
(20170320152236, 'CreateImagesTable', '2017-09-07 09:10:07', '2017-09-07 09:10:07', 0),
(20170320153235, 'CreateCategoryImageTable', '2017-09-07 09:10:07', '2017-09-07 09:10:07', 0),
(20170320153507, 'CreateArticleImageTable', '2017-09-07 09:10:08', '2017-09-07 09:10:08', 0),
(20170321152726, 'AddCategoriesSlug', '2017-09-07 09:10:08', '2017-09-07 09:10:08', 0),
(20170322132741, 'AddCategoryParentId', '2017-09-07 09:10:08', '2017-09-07 09:10:12', 0),
(20170331120618, 'AddArticleSlug', '2017-09-07 09:10:12', '2017-09-07 09:10:12', 0),
(20170331122755, 'AddImagePathExtension', '2017-09-07 09:10:12', '2017-09-07 09:10:13', 0),
(20170411214243, 'CreateUsersTable', '2017-09-07 09:10:13', '2017-09-07 09:10:14', 0),
(20170507183718, 'CreateMenuTable', '2017-09-07 09:10:14', '2017-09-07 09:10:14', 0),
(20170510184903, 'CreateTemplatesTable', '2017-09-07 09:10:14', '2017-09-07 09:10:15', 0),
(20170511140452, 'CreateContacts', '2017-09-07 09:10:15', '2017-09-07 09:10:15', 0),
(20170516205713, 'AddArticlesImageId', '2017-09-07 09:10:15', '2017-09-07 09:10:16', 0),
(20170520180821, 'CreateOrderTable', '2017-09-07 09:10:16', '2017-09-07 09:10:17', 0),
(20170710122622, 'CreateSettingsTable', '2017-09-07 09:10:17', '2017-09-07 09:10:17', 0),
(20170726172501, 'CreateContactImageTable', '2017-09-07 09:10:17', '2017-09-07 09:10:18', 0),
(20170731144752, 'AddContactImageId', '2017-09-07 09:10:18', '2017-09-07 09:10:19', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `settings`
--

INSERT INTO `settings` (`id`, `title`, `name`, `value`) VALUES
(1, 'Názov stránky', '', ''),
(2, 'Názov stránky', 'site_description', ''),
(3, 'Názov stránky', 'site_keywords', '');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `value`) VALUES
(7, 'articles', '1');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `templates`
--

INSERT INTO `templates` (`id`, `template_name`, `category_id`) VALUES
(1, 'counseling.latte', 4);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `token` varchar(100) NOT NULL,
  `image` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `first_name`, `last_name`, `token`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$RtrDEZ2eyGRGj8BOgMYmTeO6409t9ulIOS5Ovfv3ocEpKTLrIpbKG', 'admin@admin.sk', 'administrator', 'admin', 'admin', '', NULL, '2017-09-07 09:10:27', NULL, '0000-00-00 00:00:00');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `article_image`
--
ALTER TABLE `article_image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_id` (`article_id`,`image_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `category_article`
--
ALTER TABLE `category_article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_id` (`article_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexy pre tabuľku `category_image`
--
ALTER TABLE `category_image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`image_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `contact_image`
--
ALTER TABLE `contact_image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_id` (`contact_id`,`image_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexy pre tabuľku `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexy pre tabuľku `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexy pre tabuľku `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `article_image`
--
ALTER TABLE `article_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT pre tabuľku `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `category_article`
--
ALTER TABLE `category_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pre tabuľku `category_image`
--
ALTER TABLE `category_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `contact_image`
--
ALTER TABLE `contact_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pre tabuľku `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pre tabuľku `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pre tabuľku `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `article_image`
--
ALTER TABLE `article_image`
  ADD CONSTRAINT `article_image_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `article_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `category_article`
--
ALTER TABLE `category_article`
  ADD CONSTRAINT `category_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `category_article_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Obmedzenie pre tabuľku `category_image`
--
ALTER TABLE `category_image`
  ADD CONSTRAINT `category_image_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `contact_image`
--
ALTER TABLE `contact_image`
  ADD CONSTRAINT `contact_image_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `contact_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `images` (`id`);

--
-- Obmedzenie pre tabuľku `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Obmedzenie pre tabuľku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
