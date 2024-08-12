-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2022 at 04:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zavrsni_aplikacija`
--

-- --------------------------------------------------------

--
-- Table structure for table `dostava_podaci`
--

CREATE TABLE `dostava_podaci` (
  `id_podaci` int(11) NOT NULL,
  `naslov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dostava_podaci`
--

INSERT INTO `dostava_podaci` (`id_podaci`, `naslov`, `opis`) VALUES
(5, 'Narudžbe', 'Putem Pet Shop online trgovine možete kupiti većinu proizvoda, no pojedini proizvodi se zbog lomljivosti i veličine ne mogu kupiti preko interneta, već je kod tog proizvoda navedeno da se može kupiti samo u poslovnici. Kada stavite proizvod u košaricu, imate mogućnost mjenjanja količine proizvoda kojeg želite naručiti. Sve cijene su prikazane u kunama. U slučaju ako želite otkazati narudžbu, možete kontaktirati administratora i on će ju otkazati samo ako nije već isporučena.'),
(6, 'Registracija', 'Da biste koristili Pet Shop online trgovinu morate izvršiti proces registracije.\r\nRegistracija kupcima omogućuje naručivanje proizvoda, postavljanje pitanja administratoru, pregled svojih narudžba, stavljanje proizvoda u listu želja i još mnogo toga.'),
(8, 'Ukratko o kupnji i dostavi', 'Dostava se vrši diljem cijele Hrvatske, a cijena dostave je uvijek 20 kuna, a odnosi se na dostavu na jednu adresu. Cijena narudžbe je navedena u pregledu košarice prije izvršenja plaćanja. Nakon naručivanja proizvoda, pod opcijom \"Moje narudžbe\" možete preuzeti račun.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `higijena`
--

CREATE TABLE `higijena` (
  `higijena_id` int(11) NOT NULL,
  `naziv` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8 NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `dostupnost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `higijena`
--

INSERT INTO `higijena` (`higijena_id`, `naziv`, `cijena`, `slika`, `kategorija_id`, `dostupnost`, `opis`) VALUES
(22, '365 NATURE CBD Pets 5% ulje konoplje', 129.00, 'ulje_konoplje.jpg', 26, 'Online i poslovnica', 'Ulje konoplje za njegu dlake i kože. Promućkajte prije upotrebe. Najbolje upotrijebiti do datuma koji piše na proizvodu.'),
(23, 'ALL SYSTEMS Četka profesionalna Pin Brush', 216.00, 'cetka.jpg', 1, 'Online i poslovnica', 'bla'),
(24, 'ARAVA Easy Combing, regenerator za pse, za lakše rasčešljavanje', 112.00, 'regenerator.jpg', 26, 'Online i poslovnica', 'Regenerator koji vraća užitak četkanja Vašeg ljubimca. Sastav regeneratora osvježava i omekšava dlaku i pritom olakšava probleme sa zaplitanjem dlake. Poslije upotrebe dlaka je sjajna i mekana. Utrljajte u svježe opranu dlaku i pričekajte 5 - 10 minuta. Nakon toga dobro isperite mlakom vodom.'),
(25, 'Paws and Nose ARAVA Bio protector, zaštitni balzam za šape i nos', 96.00, 'protector.jpg', 1, 'Online i poslovnica', 'Štiti nježne jastučiće na šapama koji mogu postati suhi i grubi zbog leda, soli, snijega, vrućeg betona, pijeska i drugih grubih površina. Nanesite tanji sloj balzama na jastučiće šapa i utrljajte ga. Može se koristiti tijekom cijele godine, 1-2 puta tjedno.'),
(27, 'CAMON Četka M, gumeni zupci', 43.00, 'cetka2.jpg', 2, 'Online i poslovnica', 'Idealna za uklanjanje dlake u vrijeme linjanja i masažu za životinje s kratkom, oštrom ili svilenkastom dlakom. Drška od plastike i gume za sigurniji stisak.'),
(31, 'Bio-Groom šampon Crisp Apple', 122.00, 'bg__ampon_crisp_apple.jpg', 26, 'Online i poslovnica', 'Šampon za pse i mačke napravljen je od prirodnih mirisa kako bi Vašem ljubimcu pružio užitak kupanja.'),
(32, 'Inodorina Deo Spray Aloe Vera', 48.00, 'in1051.jpg', 1, 'Online i poslovnica', 'S ugodnim mirisom aloe vere.\r\nNeutralizira neugodne mirise i dezodorira te čini krzno sjajnim.\r\nPosebno prikladan za primjenu nakon šišanja ljubimca jer štiti krzno od vanjskih utjecaja.'),
(33, 'Grooming Trixie rukavica', 71.99, 'tx23392.jpg', 26, 'Online i poslovnica', 'Trixie Grooming rukavica prikladna je za češljanje pasa i mačaka kratke do srednje duge i oštre dlake.'),
(34, 'Soft Trixie četka plastična', 32.99, 'tr_etka_soft_plasti_na_10x17_cm.jpg', 1, 'Online i poslovnica', 'Za vanjsku dlaku i poddlaku.'),
(35, 'Ferplast četka za pse i mačke Slicker', 110.00, 'ferplast__etka_slicker_xl_gro5948.jpg', 26, 'Online i poslovnica', 'Za vanjsku dlaku i poddlaku.'),
(36, 'Bramton pelene Puppy Training Pads', 174.99, 'br_puppy_training_pads_56_kom_pelene.jpg', 1, 'Online i poslovnica', 'Puppy Training Pads su pelene za vršenje nužde u kući. Upijaju 10 puta više tekućine od sličnih proizvoda na tržištu zahvaljujući posebnoj tehnologiji, velikoj moći upijanja.'),
(37, 'Privlačne kapi Trixie za obavljanje nužde', 33.00, 'tx2934.jpg', 1, 'Online i poslovnica', 'U Trixie privlačnim kapima nalazi se esencijalno ulje koje privlači štence da obavljaju nuždu na peleni.'),
(38, 'Rainbow Stars dispenzer Panda Annoyed', 39.00, 'rssp216_rainbow_stars_dispenzer_panda_annoyed_zeleni.jpg', 1, 'Online i poslovnica', 'Pakiranje sadrži 14 biorazgradivih vrećica. Jednostavne su za korištenje i ne kidaju se na perforaciji. Dovoljno su duboke, jednostavno se vežu na vrhu i nepropusne su.'),
(39, 'Zatvoreni WC Trixie za mačke Berto', 300.00, 'trixie_wc_za_ma_ke_berto_tirkizni.jpg', 2, 'Online i poslovnica', 'Tirkizni zatvoreni wc za mačke.'),
(40, 'Lopatica Trixie wc za mačke sa držačem', 57.00, 'tx40475.jpg', 2, 'Online i poslovnica', 'Za sve tipove pjesaka.');

-- --------------------------------------------------------

--
-- Table structure for table `hrana`
--

CREATE TABLE `hrana` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 NOT NULL,
  `okus` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dostupnost` varchar(255) CHARACTER SET utf8 NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrana`
--

INSERT INTO `hrana` (`id`, `naziv`, `okus`, `cijena`, `slika`, `dostupnost`, `kategorija_id`, `opis`) VALUES
(71, 'PUPIL PRIME Vrecica', 'Kunic', 4.29, 'pupil_prime_kunić.jpg', 'Online i poslovnica', 3, 'Potpuna hrana za odrasle mačke. S kunićevinom, komadići u umaku. Ponudite na sobnoj temperaturi. Čuvajte na suhom i hladnom mjestu. Nakon otvaranja čuvajte u hladnjaku te potrošite unutar 48h.'),
(74, 'REMI Sterilised', 'Riba', 37.90, 'remi_sterilised.jpg', 'Online i poslovnica', 2, 'REMI receptura s pažljivo odabranim kvalitetnim sastojcima potpun je i lakoprobavljiv dnevni obrok, prilagođen specifičnim potrebama steriliziranih mačaka. Dnevna količina može se podijeliti u dva obroka. Količine su indikativne i mogu se prilagoditi specifičnim potrebama svake mačke. Svježa pitka voda mora uvijek biti dostupna. Proizvod čuvajte na suhom, tamnom i zračnom mjestu, pri sobnoj temperaturi.'),
(75, 'ASPECT', 'Piletina s rizom', 119.99, 'aspect_piletinariza.jpg', 'Online i poslovnica', 1, 'Potpuna hrana za odrasle pse. Obrok možete poslužiti u suhom obliku ili po potrebi omekšati s malo mlake vode. Preporučena dnevna količina hrane (g/dnevno) prema tjelesnoj masi psa (kg) navedena je u tablici otisnutoj na pakiranju. Količine su indikativne i mogu se prilagoditi specifičnim potrebama svakog psa.'),
(76, 'MINI BRIT CARE', 'Janjetina', 99.00, 'brit_care_mini.jpg', 'Online i poslovnica', 1, 'Hranu treba podijeliti na 3 - 5 jednakih obroka tijekom dana. Hranu poslužite suhu ili navlaženu mlakom vodom. Kada psu prvi put dajete Brit Care, pomiješajte je s hranom koju ste prethodno upotrebljavali te tijekom 7 dana postupno povećavajte udio hrane Brit Care. Dnevna količina može varirati ovisno o okolišu, razini aktivnosti i dobi vašega psa. Svježa voda neka je uvijek dostupna vašem ljubimcu.'),
(81, 'BRIT ANIMALS Cincile', 'Jabuke', 69.95, 'brit_animals_chinchilla.jpg', 'Online i poslovnica', 7, 'Potpuna hrana za činčile. Super premium hrana-potpuni obrok s vitaminima i hranjivim tvarima. Bez dodatka šećera.  Optimalna dnevna količina je jedna jušna žlica granula. Tijekom prelaska pomiješajte mali dio Brit hrane s prethodnom hranom i postupno povećavajte količinu. Hranite u skladu s apetitom vaše činčile. '),
(121, 'DAJANA Wafer Discs MIX', 'Nema', 21.50, 'hrana_ribe.jpg', 'Online i poslovnica', 16, 'Potpuna hrana za sve ukrasne ribe i rakove koji žive na dnu slakovodnih i morskih akvarija u obliku tonućih diskova. Hraniti umjereno, s količinom koju riba može pojesti u nekoliko minuta. Čuvati na suhom i tamnom mjestu.'),
(126, 'Pro Plan Veterinary Diets HP Hepatic', 'Kukuruz', 125.00, 'pro_plan_cat_hepatic_1_5_kg.jpg', 'Online i poslovnica', 2, 'Pro Plan Veterinary Diets HP Hepatic potpuna je dijetetska hrana za odrasle mačke s kroničnim zatajenjem jetre. Napravljena od visokokvalitetnih bjelančevina, hrana je visokoenergetska, prehrana koja sadrži umjerenu količinu bjelančevina te je obogaćena antioksidansima i esencijalnim masnim kiselinama koje pomažu u podršci bolestima jetre.'),
(127, 'Gourmet Mon Petit', 'Puretina, piletina, pačetina', 16.70, 'gourmet_mon_petit_puretina_piletina_pace._6x50_g.jpg', 'Online i poslovnica', 2, 'Kutija sadrži 6 vrećica hrane'),
(128, 'Acana CAT Indoor Entrée', 'Piletina', 380.00, 'ns_acana_cat_indoor_entree_front_left_4.5kg_1.jpg', 'Online i poslovnica', 2, 'Vrećica hrane od 4,5 kilograma.'),
(129, 'Happy Dog Vet Line Renal', 'Kukuruz', 60.00, 'happy_dog_vet_line_renal_1__2.jpg', 'Online i poslovnica', 1, 'Happy Dog VET Renal koristi se za rasterećenje bubrega u slučajevima akutne i kronične bubrežne insuficijencije. Ova dijetetska prehrana odlikuje se udjelom visokoprobavljivih bjelančevina, fosfora i natrija specifično prilagođenih ovim potrebama. Izrazito ukusna receptura kao izvore bjelančevina sadrži mesno brašno, losos i jaje.'),
(130, 'Tetra Pond Variety sticks', 'Nema', 130.00, 'variety_sticks.jpg', 'Online i poslovnica', 16, 'Hrana za ribe, prospite malo hrane u akvarij'),
(131, 'Cichlid  Tetra Granules', 'Mješavina hrane', 145.00, 'tetra_chiclid_granule_500_ml.jpg', 'Online i poslovnica', 16, 'Hranite najmanje dva ili tri puta dnevno onoliko koliko vaša riba može pojesti u nekoliko minuta.'),
(132, 'Hagen Exo Terra hrana za reptile', 'Nema', 39.99, 'hagen_exo_terra_bra_nari.jpg', 'Online i poslovnica', 24, 'Pomaže u izgradnji kostiju, hrskavice, kože i kandži. Insekti iz konzerve imaju jednaku hranjivu vrijednost kao živi insekti, ali su lakši za probavu. Uz ove konzervirane nije potrebno hraniti živim insektima.'),
(133, 'Cuni Versele Laga Complete', 'Nema', 41.99, 'vlg_cuni_complete.jpg', 'Online i poslovnica', 3, 'Hrana bez žitarica s dugim vlaknima posebno je prilagođena prehrambenim potrebama odraslog kunića.'),
(134, 'Vitakraft hrana Menu za ježeve', 'Nema', 9.99, 'vitakraft_menu_za_je_eve_100_g.jpg', 'Online i poslovnica', 25, 'Hrana za ježeve, dajte ježu hranu u neku malu posudicu.'),
(135, 'Versele Laga Patee Gold Red', 'Nema', 9.99, 'versele_laga_patee_frutti_250_g_1.jpg', 'Online i poslovnica', 4, 'Ovo je jajačana hrana neophodna tijekom sezone parenja, ali i tijekom ostatka godine. Izvor je dodatnih hranjivih tvari. Gotova hrana od jaja s crvenim bojama za kanarince, europske i tropske zebice. Navlažena je 100% prirodnim medom'),
(136, 'Beaphar Joint fit prah', 'Nema', 165.00, 'b16113.jpg', 'Online i poslovnica', 26, 'Za pse i mačke, za štence od 3 mjeseca starosti, skotne životinje i one koje doje. Dodatak hrani za pokretljivost zglobova.'),
(137, 'Grizzly Wild Losos Oil', 'Nema', 139.99, 'grizzly_wild_losos_oil_1000ml_2__2.jpg', 'Online i poslovnica', 26, 'Proizvod dobiven od divljeg lososa. Osigurava veliku količinu omega 3 masnih kiselina EPA i DHA kao i ograničenu količinu omega 6 masnih kiselina.'),
(138, 'Premiere Cat Meat Menu Adult meso mix', 'Govedina, piletina', 14.99, 'premier_meat_menu_adult_meso_mix_400_g_konzerva.jpg', 'Online i poslovnica', 2, 'Premiere Cat Meat Menu Adult meso mix je potpuna hrana za odrasle mačke sa 100% svježim mesom. Recept je bez žitarica, a ne sadrži soju, šećer ili umjetne arome. S vrijednim taurinom.'),
(139, 'Adult Acana Small Breed', 'Piletina', 215.00, 'acana_adult_small_breed_6_kg.jpg', 'Online i poslovnica', 1, 'Acana Adult Small Breed potpuna je hrana za odrasle pse puna piletine iz slobodnog uzgoja, divljeg iverka i jaja nesilica iz slobodnog uzgoja. Svi sastojci su dostavljeni svježi u WholePrey omjerima te su bogati hranjivim tvarima i izvrsnog su okusa.Bez žitarica i “brzih” ugljikohidrata poput riže, tapioke ili krumpira, Acana je bogata mesnim bjelančevinama koje podupiru zdravlje i vrhunsku kondiciju.Pripremljena u našim nagrađivanim kuhinjama od najboljih i najsvježijih kanadskih sastojaka,'),
(140, 'Singles Acana Grass', 'Janjad', 260.00, 'acana_singl_grass-fed_lamb_11_4_kg_1.jpg', 'Online i poslovnica', 1, 'Acana Grass-Fed Lamb potpuna je hrana za pse s ograničenim sastojcima. Sadrži 50% janjetine, jedan lako probavljiv izvor životinjskih bjelančevina koji je savršen za nutritivno osjetljive pse svih pasmina i dobi.');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorija_id` int(11) NOT NULL,
  `naziv_kategorija` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorija_id`, `naziv_kategorija`) VALUES
(1, 'Pas'),
(2, 'Mačka'),
(3, 'Zec'),
(4, 'Ptica'),
(5, 'Zmija'),
(6, 'Hrčak'),
(7, 'Miš'),
(9, 'Neodređeno'),
(10, 'Tarantula'),
(14, 'Gušter'),
(15, 'Kornjače'),
(16, 'Ribe'),
(24, 'Insekti'),
(25, 'Jež'),
(26, 'Više životinja');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `korisnik_id` int(11) NOT NULL,
  `korisnik` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `tip_korisnika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `telefon` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `odobrenje` tinyint(1) NOT NULL,
  `datum_registracije` date NOT NULL DEFAULT current_timestamp(),
  `procitano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnik_id`, `korisnik`, `lozinka`, `tip_korisnika`, `user_status`, `email`, `telefon`, `odobrenje`, `datum_registracije`, `procitano`) VALUES
(12, 'Admin', '$2y$10$c0VCX6lx.KOmaTbtvAav1eWolmi.jxLrS9IdmdeWqSZ9n10ppTKX.', 'admin', 0, 'admin@gmail.com', '0975364789', 0, '2022-03-03', 0),
(126, 'Vanja', '$2y$10$voxS2MM6knCpo0LziTImEuADnqN.xlY9.b1hS9o0YHZ1klsdH/lWu', 'korisnik', 0, 'vanja@gmail.com', '0986543217', 0, '2022-09-07', 0),
(127, 'Marko', '$2y$10$vX3iMV9wd81KMFAb4PPru.fnJl1o0NvnNSD/LvXAEb7CUEZh2/R4S', 'korisnik', 0, 'marko@gmail.com', '0986543210', 0, '2022-09-07', 0),
(128, 'Borna', '$2y$10$tgokJviuQ1vCvvlpOuamR.UU8n7LDmD3kMAyN4E9Q.FdjGNMy.zb2', 'korisnik', 0, 'borna@gmail.com', '0986543212', 0, '2022-09-07', 0),
(130, 'Zvonko', '$2y$10$M9k5jvbciwq1GnHBii4h7udc.vuq/iTUDVqUNFv8cHX4x/gaN4kYi', 'korisnik', 0, 'zvonko@gmail.com', '0986543215', 0, '2022-09-07', 0),
(132, 'Slavica', '$2y$10$cu4gtBkWXDTrpzBwxdi67eVBln1R/FY.wlDwd/Xmd4HUnCZ6tfh42', 'korisnik', 0, 'slavica@gmail.com', '0986543287', 0, '2022-09-07', 0),
(134, 'Emanuel', '$2y$10$Gd8rG4dCnDlDx/B7RIYhIetVVqlpSAe1esv1UwpwbfnKS9dxnGfdy', 'korisnik', 0, 'emanuel@gmail.com', '0976523897', 0, '2022-09-11', 0),
(135, 'Jana', '$2y$10$MyAOk0G9GUDYPhpEJd6WBeouCSoFoYLsLagAOP5NVCUawxDO2qEwm', 'korisnik', 0, 'jana@gmail.com', '0976523894', 0, '2022-09-11', 0),
(136, 'Dora', '$2y$10$4yb1T3zOar56fk7nUYu9TO3iSu9k0fplVo2rNd5Xg.3RTaUD8k5Am', 'korisnik', 0, 'dora@gmail.com', '0976523895', 0, '2022-09-11', 0),
(137, 'Ivan', '$2y$10$fcwHa/8FVb1Uhu5vfL3r4udP1tzUpATpGsUN1SXdOKzVk6RiiN3fO', 'korisnik', 0, 'ivan@gmail.com', '0987162564', 0, '2022-09-11', 0),
(138, 'Damir', '$2y$10$4w8GJcl8tKi4wa6a7yPOXeN8L7eEU.VVJsJk/cRkib3U/b7w1Uxmm', 'korisnik', 0, 'damir@gmail.com', '0987162568', 0, '2022-09-11', 0),
(139, 'Antonija', '$2y$10$HMZs95v64nCAdkGPsvOHieae585Cy5HaLEpeSNapZxp/mXh5CP1ZC', 'korisnik', 0, 'antonija@gmail.com', '0987651234', 0, '2022-09-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kosarica`
--

CREATE TABLE `kosarica` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kolicina` int(11) NOT NULL,
  `korisnik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kosarica`
--

INSERT INTO `kosarica` (`id`, `naziv`, `cijena`, `slika`, `kolicina`, `korisnik`, `korisnik_id`) VALUES
(293, 'CAMON', 43.95, 'vodilica.jpg', 1, 'Admin', 12),
(294, 'ACDC', 89.95, 'majca_psi.jpg', 1, 'Admin', 12),
(307, 'Cats', 165.00, 'cats_best_original_posip_za_macke_8_6_kg.jpg', 1, 'Admin', 12),
(308, 'AQUAEL', 999.00, 'akvarij2.jpg', 1, 'Admin', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ljubimci`
--

CREATE TABLE `ljubimci` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `starost` int(11) NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8 NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `dostupnost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ljubimci`
--

INSERT INTO `ljubimci` (`id`, `naziv`, `ime`, `starost`, `cijena`, `slika`, `kategorija_id`, `dostupnost`, `opis`) VALUES
(4, 'Belgijski ovčar', 'Rex', 2, 1500.00, 'belgijski_ovcar.jpg', 1, 'Samo u poslovnici', 'Naš Rex je pasmine belgijski ovčar, koji je star jednu godinu i traži svoj dom, gdje će ga svi voljeti. On zahtjeva duge šetnje, puno jesti i puno rada s njim.'),
(14, 'Maltezer ', 'Rio ', 3, 1100.00, 'maltezer.jfif', 1, 'Samo u poslovnici', 'Mali Rio je pasmine maltezer i vrlo je zaigran i veseo. Voli pažnju i da ga svi oko njega maze i paze.'),
(16, 'Narančasta mačka', 'Garfield', 2, 3500.00, 'narancasta_macka.jpg', 2, 'Samo u poslovnici', 'Ovaj mali mačić je dobio ime po poznatom dječjem filmu - Garfield. On je, kao i Garfield iz crtića malo zbunjen i zmotan, ali voli se maziti i igrati.'),
(54, 'Haski', 'Još nema ime', 0, 1000.00, '1000_F_39514331_vhP4nyt3VjrfGZUa0VBVkmuqheHluR8g.jpg', 1, 'Samo u poslovnici', 'Štene haskija na prodaju. Ima pola godine i čeka svoj novi dom. Cijepljen i tretiran protiv nametnika.'),
(55, 'Bigl', 'Još nema ime', 0, 950.99, '71560202206231302562353.jpeg', 1, 'Samo u poslovnici', 'Štene bigl traži svoj dom, cijepljen, tretiran protiv nametnika.'),
(56, 'Australski ovčar', 'Još nema ime', 0, 1500.00, 'Australian-Shepherd-puppy-3-months-old-laying-down-in-the-shade-with-a-toy.jpeg', 1, 'Samo u poslovnici', 'Štene austrilskog ovčara cijepljen i tretiran protiv nametnika traži svoj novi dom.'),
(57, 'Belgijski ovčar', 'Još nema ime', 0, 2000.00, 'belgijski-ovcar-malinois-parenje-slika-56296981.jpg', 1, 'Samo u poslovnici', 'Štenci su cijepljeni i tretirani protiv nametnika.'),
(58, 'Labrador', 'Još nema ime', 0, 1000.00, 'Labrador-retriever-puppy-laying-down-in-the-shade-at-home.jpeg', 1, 'Samo u poslovnici', 'Štenac labradora cijepljen i tretiran protiv nametnika.'),
(59, 'Škotski ovčar', 'Još nema ime', 0, 1000.00, 'skotski-ovcar-najava-legla-slika-68868937.jpg', 1, 'Samo u poslovnici', 'Škotski ovčar cijepljen i tretiran protiv nametnika.'),
(60, 'Njemački ovčar', 'Još nema ime', 0, 1300.00, 'stenci-njemackog-ovcara-slika-155978454.jpg', 1, 'Samo u poslovnici', 'Štenci njemačkog ovčara cijepljeni i tretirani protiv nametnika.'),
(61, 'Američki kurl', 'Nema ime', 1, 2000.00, 'american-curl-kitten-3-months-old-sitting-looking_191971-4644.jpg', 1, 'Samo u poslovnici', 'Maca tretirana protiv nametnika i cijepljena traži svoj novi dom.'),
(62, 'Somalijska mačka', 'Nema ime', 2, 4500.00, 'somalicat_249541327.jpg', 2, 'Samo u poslovnici', 'Mačka cijepljena i tretirana protiv nametnika traži svoj novi dom.');

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `narudzba_id` int(11) NOT NULL,
  `korisnik` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postanski_broj` int(5) NOT NULL,
  `proizvod` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `totalna_cijena` double(11,2) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `datum_narudzbe` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `placanje_id` int(11) NOT NULL,
  `primatelj` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`narudzba_id`, `korisnik`, `prezime`, `telefon`, `email`, `ulica`, `grad`, `postanski_broj`, `proizvod`, `totalna_cijena`, `korisnik_id`, `datum_narudzbe`, `status`, `placanje_id`, `primatelj`) VALUES
(88, 'Borna', '', '0986543212', 'borna@gmail.com', 'Carinski odv.', 'Čakovec', 40000, 'Acana (2) , Versele (3) ', 549.97, 128, '2022-09-11', 2, 3, 'AZIL PRIJATELJI'),
(89, 'Vanja', '', '0986543217', 'vanja@gmail.com', 'Trg Pavla Štoosa 39', 'Varaždin', 42205, 'Trixie (1) , Zeleni (1) , BLUTIVE (1) ', 452.99, 126, '2022-09-11', 1, 2, 'UDRUGA ZA ZAŠTITU ŽIVOTINJA SPAS'),
(90, 'Vanja', '', '0986543217', 'vanja@gmail.com', 'Ulica Miroslava Krleže', 'Varaždin', 42205, 'ALL (1) , 365 (2) ', 474.00, 126, '2022-09-11', 2, 2, 'Vanja'),
(91, 'Borna', '', '0986543212', 'borna@gmail.com', 'Letičani 5', 'Bjelovar', 43000, 'FERPLAST (1) , BLUTIVE (2) , Trixie (1) ', 385.97, 128, '2022-09-11', 1, 3, 'DRUŠTVO ZA ZAŠTITU ŽIVOTINJA ŠAPA'),
(92, 'Zvonko', '', '0986543215', 'zvonko@gmail.com', 'Ulica Ivana Radića', 'Varaždin', 42205, 'Zatvoreni (1) , Lopatica (1) ', 357.00, 130, '2022-09-11', 0, 2, 'Zvonko'),
(93, 'Marko', '', '0986543210', 'marko@gmail.com', 'Ulica Josipa Kozarca', 'Varaždin', 42000, 'Singles (1) , Adult (1) , Gourmet (3) ', 525.10, 127, '2022-09-11', 0, 3, 'Marko'),
(94, 'Damir', '', '0987162568', 'damir@gmail.com', 'Carinarski odv.', 'Čakovec', 40000, 'BRIT (2) , MINI (1) ', 238.90, 138, '2022-09-11', 0, 2, 'AZIL PRIJATELJI'),
(95, 'Antonija', '', '0987651234', 'antonija@gmail.com', 'Ulica Josipa Kozarca', 'Varaždin', 42200, 'CAMON (1) , CANON (1) ', 68.90, 139, '2022-09-11', 1, 3, 'UDRUGA / SKLONIŠTE'),
(96, 'Dora', '', '0976523895', 'dora@gmail.com', 'Ulica Miroslava Krleže', 'Varaždin', 42000, 'Paws (2) , ARAVA (1) ', 304.00, 136, '2022-09-11', 0, 2, 'UDRUGA ZA ZAŠTITU ŽIVOTINJA SPAS'),
(97, 'Jana', '', '0976523894', 'jana@gmail.com', 'Ulica Doktora Debana', 'Čakovec', 40000, 'Adult (1) , Premiere (5) ', 289.95, 135, '2022-09-11', 3, 2, 'Jana'),
(98, 'Emanuel', '', '0976523897', 'emanuel@gmail.com', 'Zagrebačka ulica', 'Varaždin', 42000, 'Marcela (1) , Trixie (1) , Singles (1) ', 1270.00, 134, '2022-09-11', 0, 3, 'Emanuel');

-- --------------------------------------------------------

--
-- Table structure for table `oprema`
--

CREATE TABLE `oprema` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8 NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `dostupnost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oprema`
--

INSERT INTO `oprema` (`id`, `naziv`, `cijena`, `slika`, `kategorija_id`, `dostupnost`, `opis`) VALUES
(72, 'CAMON Ham i vodilica Big Cat', 43.95, 'vodilica.jpg', 2, 'Online i poslovnica', 'Vodilica za mačke,120 x 1,3 cm. Pažljivo stavite na mačku oko vrata i ispod trbuha.'),
(73, 'CANON ogrlica', 24.95, 'vodilica2.jpg', 2, 'Online i poslovnica', 'Stavite ogrlicu mački pažljivo oko vrata'),
(74, 'ACDC Majica  ', 89.95, 'majca_psi.jpg', 1, 'Online i poslovnica', 'Slučajno gutanje proizvoda može dovesti do neželjenih učinaka. U slučaju gutanja čak i najmanjeg komadića proizvoda kontaktirajte svog veterinara. Ne ostavljajte svog ljubimca bez nadzora tijekom nošenja odjeće. Prilikom nanošenja sredstva protiv buha obavezno mu skinite odjeću jer uvijek postoji mogućnost alergijske reakcije s materijalom od kojeg je izrađena odjeća.'),
(75, 'ALCOTT Adventure Vodilica na regulaciju ', 89.99, 'vodilice.jpg', 1, 'Online i poslovnica', 'Za povećavanje trake kliknite gumbić na površini, isto tako i sa smanjivanjem.'),
(76, 'FERPLAST Hranilica za ptice Pretty FPI', 29.99, 'hranilica.jpg', 4, 'Online i poslovnica', 'Prozirna hranilica za ptice 9x9x9 cm'),
(77, 'AQUATLANTIS Stakleni terarij Smart line  ', 499.00, 'terarij.jpg', 5, 'Samo u poslovnici', 'Stakleni terarij sa lokotom, opremljen kamenčićima i umjetnom travom. 30x30x30cm, crni'),
(78, 'Akvarij stakleni za kornjače ', 169.99, 'akvarij.jpg', 15, 'Samo u poslovnici', '60x30x30cm / 4mm, 54l'),
(79, 'AQUAEL Akvarijski set Leddy Day&Night 75 ', 999.00, 'akvarij2.jpg', 16, 'Online i poslovnica', 'Potpuno opremljen akvarij s Leddy LED rasvjetnom tehnologijom. Set uključuje pravokutni spremnik za vodu, poklopac od plastike s otvorom za olakšano hranjenje i održavanje, napredni LEDDY TUBE rasvjetni modul ugrađen u poklopac, grijač i unutarnji filter. Ugrađen LEDDY TUBE SUNNY rasvjetni modul emitira snažno svjetlo čiji je spektar sličan suncu. Namijenjeno početnicima kao i iskusnijim akvaristima.'),
(80, 'Panorama  Akvarij stakleni', 129.95, 'akvarij_panorama.jpg', 16, 'Samo u poslovnici', '30x20x24cm / 4mm, 14L'),
(81, 'Kvarcni Aqua Šljunak Amazonija mix', 49.00, 'sljunak.jpg', 16, 'Online i poslovnica', 'Brand - Aqua'),
(82, 'Riječni Aqua Šljunak višebojni', 10.00, 'sljunak1.jpg', 16, 'Online i poslovnica', 'Brand - Aqua'),
(90, 'Plavi Trixie transporter Capri', 160.00, 'tr_transporter_capri_1_plavi_32x31x48_cm.jpg', 2, 'Online i poslovnica', 'Box za transport za mačke i male pse do 10kg.'),
(91, 'Zeleni Trixie transporter Capri', 160.00, 'tr_transporter_capri_1_zeleni_32x31x48_cm.jpg', 2, 'Online i poslovnica', 'Box za transport za mačke i male pse do 10 kg.'),
(93, 'Metalna posuda Trixie', 45.00, 'zdjelica.jpg', 1, 'Online i poslovnica', 'Neklizajuća posudica zbog gumenog podnožja. Materijal je nehrđajući čelik / plastika.'),
(94, 'Posuda ferplast za pse Mira', 34.99, 'ferplast_posuda_mira_crna_3.jpg', 1, 'Online i poslovnica', 'Ferplast posuda za pse je čvrsta, izdržljiva i higijenski izrađena. Ima gumeno podnožje pa se ne može klizat. Pogodna je za sve vrste hrane i vodu te vrlo jednostavna za čišćenje.'),
(96, 'BLUTIVE pijesak za mačke Lavander', 62.99, 'blutive_pijesak_za_ma_ke_lavander.jpg', 2, 'Online i poslovnica', 'Grudajući pijesak s mirisom, ima odlična upijajuća svojstva, dugotrajnost i kontrolu mirisa.'),
(97, 'Cats Best Original posip za mačke', 165.00, 'cats_best_original_posip_za_macke_8_6_kg.jpg', 2, 'Online i poslovnica', 'Grudajući pijesak napravljen od aktivnih drvnih vlakana. Laku upije i ne praši se. Prirodno i bez kemijskih dodataka.Napunite higijensku posudu s pijeskom tako da ga bude do 7 cm visine.'),
(98, 'Ferplast krletka Regina Brass', 420.00, 'ferplast_krletka_regina_brass_32_5x49_cm.jpg', 4, 'Online i poslovnica', 'Ferplast Regina je okrugla i mala krletka za kanarince i male ptice. Opremljena je plastičnom podlogom s dvije plastične posudice. Dolazi s ljuljačkom, igračkom s malim zvoncem, pojilicom i hranilicom.'),
(99, 'Ferplast pojilica za ptice Univer', 24.00, 'ferplast_pojilica_za_ptice_univer.jpg', 4, 'Online i poslovnica', 'Materijal - čvrsta plastika'),
(100, 'Trixie grebalica za mačke Espejo', 230.00, 'tx43342_trixie_grebalica_za_ma_ke_espejo_69_cm_siva.jpg', 2, 'Samo u poslovnici', 'Trixie grebalica za mačke sastoji se od dva postolja i užeta za grebanje.'),
(101, 'Marcela Trixie grebalica za mačke', 780.00, 'tr_macka_grebalica_marcela_60_cm_siva.jpg', 2, 'Samo u poslovnici', 'Podstavljeno postolje s odvojivim krevetom koji se može prati isključivo ručno.'),
(102, 'Zamora Trixie grebalica za mačke', 230.00, 'grebalica22.jpg', 2, 'Samo u poslovnici', 'Grebalica je obložena plišanim materijalom, a stup za grebanje obavijen je prirodnim konopom od sisala.'),
(103, 'Be Nordic Amrum Trixe krevet za pse', 416.00, 'tx37442_krevet_be_nordic_amrum.jpg', 1, 'Online i poslovnica', 'Trixe krevet za pse Be Nordic Amrum ima presvaku od mekanog poliestera punjenu pahuljicama od pjene s ugrađenim jastukom. Navlaka je uklonjiva i periva na 60°C.');

-- --------------------------------------------------------

--
-- Table structure for table `placanje_podaci`
--

CREATE TABLE `placanje_podaci` (
  `placanje_id` int(11) NOT NULL,
  `vrsta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `placanje_podaci`
--

INSERT INTO `placanje_podaci` (`placanje_id`, `vrsta`, `opis`) VALUES
(2, 'Plaćanje gotovinom ', 'Gotovinski plaćanje dostavljaču pri preuzimanju pošiljke. Gotovinsko plaćanje moguće je za sve adrese na području Republike Hrvatske.'),
(3, 'Kartično plaćanje dostavljaču', 'Prilikom preuzimanja pošiljke moguće je jednokratno kartično plaćanje dostavljaču.');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `poruke_id` int(11) NOT NULL,
  `pitanje` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `odgovor` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `korisnik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datum_poruke` date NOT NULL DEFAULT current_timestamp(),
  `vrsta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_poruke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`poruke_id`, `pitanje`, `odgovor`, `korisnik_id`, `korisnik`, `datum_poruke`, `vrsta`, `status_poruke`) VALUES
(21, '                                 Poštovanje, zanima me moje stanje narudžbe.   ', 'Poštovana Vanja, stanje Vaše narudžbe možete vidjeti na dnu detalja svoje narudžbe. Do tamo možete doći klikom na opciju \"Moje narudžbe\" dok kliknete na košaricu pored svog imena te dok kliknete na pojedinu narudžbu da Vam se pokažu detalji te narudžbe. Molimo Vas da ubuduće dok postavljate pitanja o narudžbi, napišete koji je broj Vaše narudžbe da znamo što gledati.', 126, 'Vanja', '2022-09-11', 'Stanje narudžbe', 2),
(22, '              Poštovanje,\r\nTrebao bih R1 račun, pa Vam šaljem sljedeće podatke o firmi: Firma 1, Adresa firme, Poštanski broj... Hvala!                       ', 'Poštovani Marko, R1 račun Vam je izdan. Lijep pozdrav!', 127, 'Marko', '2022-09-11', 'Izdavanje R1 računa', 1),
(23, '                      Pozdrav,\r\nZanima me plaćaju li se troškovi dostave?      ', 'Poštovana Slavica, troškovi dostave na našoj aplikaciji se ne plaćaju! Srdačan pozdrav.', 132, 'Slavica', '2022-09-11', 'Dostava', 1),
(24, '                      Pozdrav,\r\nzainteresiran sam za kupnju belgijskog ovčara kojeg sam vidio na aplikaciji te me zanima je li još dostupan i u koje doba dana ga mogu doći vidjeti?              ', 'Poštovani Borna, štene belgijskog ovčara je još uvijek kod nas i možete ga doći vidjeti u poslovnicu bilo koji radni dan od 8:00-16:00', 128, 'Borna', '2022-09-11', 'Ostalo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `raspored_otoci`
--

CREATE TABLE `raspored_otoci` (
  `raspored_id` int(11) NOT NULL,
  `dan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otoci` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `raspored_otoci`
--

INSERT INTO `raspored_otoci` (`raspored_id`, `dan`, `otoci`) VALUES
(6, 'Ponedjeljak', 'Cres, Lošinj, Ugljan, Pašman, Murter'),
(7, 'Utorak', 'Rab, Pag, Vir, Korčula, Pašman'),
(8, 'Srijeda', 'Krk, Ugljan, Dugi otok'),
(9, 'Četvrtak', 'Cres, Lošinj, Ugljan, Pašman, Murter, Vir'),
(10, 'Petak', 'Pag, Vir, Korčula, Vis'),
(11, 'Svaki radni dan', 'Brač, Hvar, Lošinj');

-- --------------------------------------------------------

--
-- Table structure for table `upiti`
--

CREATE TABLE `upiti` (
  `id` int(11) NOT NULL,
  `pitanje` varchar(255) CHARACTER SET utf8 NOT NULL,
  `korisnik` varchar(255) CHARACTER SET utf8 NOT NULL,
  `odgovor` varchar(500) CHARACTER SET utf8 NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `odobrenje` tinyint(1) NOT NULL,
  `procitano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upiti`
--

INSERT INTO `upiti` (`id`, `pitanje`, `korisnik`, `odgovor`, `korisnik_id`, `odobrenje`, `procitano`) VALUES
(120, 'Je li moguće izdavanje R1 računa?', 'Vanja', 'Za izdavanje R1 računa preko aplikacije potrebno je kontaktirati administratora sa podacima o firmi.', 126, 0, 0),
(121, 'Mogu li narudžbu napraviti telefonski?', 'Marko', 'Narudžbu nije moguće napraviti telefonski. Možete ili doći u poslovnicu ili naručiti preko aplikacije.', 127, 0, 0),
(122, 'Koji su načini plaćanja na aplikaciji?', 'Borna', 'Možete platiti dostavljaču gotovinom ili karticom.', 128, 0, 0),
(123, 'Kako kupiti jednog od ljubimaca na aplikaciji?', 'Zvonko', 'Aplikacija samo prikazuje koje ljubimce imamo u poslovnici. Ukoliko ste zainteresirani za nekog od ljubimaca, možete ih osobno doći pogledati u poslovnicu i kupiti ako želite.', 130, 0, 0),
(124, 'Plaćaju li se troškovi dostave?', 'Slavica', 'Troškovi dostave se ne plaćaju.', 132, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cijena` double(11,2) NOT NULL,
  `slika` varchar(255) CHARACTER SET utf8 NOT NULL,
  `korisnik` varchar(255) CHARACTER SET utf8 NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `naziv`, `cijena`, `slika`, `korisnik`, `korisnik_id`) VALUES
(34, 'Zeleni', 160.00, 'tr_transporter_capri_1_zeleni_32x31x48_cm.jpg', 'Admin', 12),
(35, 'BRIT', 69.95, 'brit_animals_chinchilla.jpg', 'Admin', 12),
(36, '365', 129.00, 'ulje_konoplje.jpg', 'Admin', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dostava_podaci`
--
ALTER TABLE `dostava_podaci`
  ADD PRIMARY KEY (`id_podaci`);

--
-- Indexes for table `higijena`
--
ALTER TABLE `higijena`
  ADD PRIMARY KEY (`higijena_id`),
  ADD KEY `kategorija_id` (`kategorija_id`);

--
-- Indexes for table `hrana`
--
ALTER TABLE `hrana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorija_id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `kosarica`
--
ALTER TABLE `kosarica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `ljubimci`
--
ALTER TABLE `ljubimci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`narudzba_id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `placanje_id` (`placanje_id`);

--
-- Indexes for table `oprema`
--
ALTER TABLE `oprema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`);

--
-- Indexes for table `placanje_podaci`
--
ALTER TABLE `placanje_podaci`
  ADD PRIMARY KEY (`placanje_id`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`poruke_id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `raspored_otoci`
--
ALTER TABLE `raspored_otoci`
  ADD PRIMARY KEY (`raspored_id`);

--
-- Indexes for table `upiti`
--
ALTER TABLE `upiti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dostava_podaci`
--
ALTER TABLE `dostava_podaci`
  MODIFY `id_podaci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `higijena`
--
ALTER TABLE `higijena`
  MODIFY `higijena_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `hrana`
--
ALTER TABLE `hrana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `kosarica`
--
ALTER TABLE `kosarica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `ljubimci`
--
ALTER TABLE `ljubimci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `narudzba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `oprema`
--
ALTER TABLE `oprema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `placanje_podaci`
--
ALTER TABLE `placanje_podaci`
  MODIFY `placanje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `poruke_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `raspored_otoci`
--
ALTER TABLE `raspored_otoci`
  MODIFY `raspored_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `upiti`
--
ALTER TABLE `upiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `higijena`
--
ALTER TABLE `higijena`
  ADD CONSTRAINT `higijena_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`kategorija_id`);

--
-- Constraints for table `hrana`
--
ALTER TABLE `hrana`
  ADD CONSTRAINT `hrana_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`kategorija_id`);

--
-- Constraints for table `kosarica`
--
ALTER TABLE `kosarica`
  ADD CONSTRAINT `kosarica_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);

--
-- Constraints for table `ljubimci`
--
ALTER TABLE `ljubimci`
  ADD CONSTRAINT `ljubimci_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`kategorija_id`);

--
-- Constraints for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD CONSTRAINT `narudzba_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`),
  ADD CONSTRAINT `narudzba_ibfk_2` FOREIGN KEY (`placanje_id`) REFERENCES `placanje_podaci` (`placanje_id`);

--
-- Constraints for table `oprema`
--
ALTER TABLE `oprema`
  ADD CONSTRAINT `oprema_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`kategorija_id`);

--
-- Constraints for table `poruke`
--
ALTER TABLE `poruke`
  ADD CONSTRAINT `poruke_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);

--
-- Constraints for table `upiti`
--
ALTER TABLE `upiti`
  ADD CONSTRAINT `upiti_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
