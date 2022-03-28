-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Mar 2022, 18:03
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'Procesory'),
(3, 1, 'AMD'),
(4, 0, 'GPU'),
(5, 4, 'INVIDIA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `page_content` text COLLATE utf8_polish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'glowna', '<div>\r\n	<h1>Loty kosmiczne</h1>\r\n	<br/>\r\n	<h3>Kosmiczny teleskop Jamesa Webba</h3>\r\n	<div>\r\n	<img  src=\"image/glowna2.jpg\">\r\n	</div>\r\n	<figcaption style=\" text-align: center;\">Foto: ESA/CNES/Arianespace</figcaption>\r\n	<br/>\r\n	<p>Kosmiczny teleskop powstawał przez lata i w końcu jest gotowy do wystrzelenia w kosmos. NASA, ESA oraz kanadyjska agencja planują start 22grudnia 2021roku. Teleskop ma polecieć na tego dnia na szczycie rakiety <b>Ariane 5</b> firmy Arianespace z Gujany Francuskiej.</p>\r\n</div>\r\n<div>\r\n	<h1>Voyager 2</h1>\r\n	<img src=\"image/voyager.jpg\"><p>bezzałogowa sonda kosmiczna wysłana w 1977 roku w przestrzeń kosmiczną z Przylądka Canaveral przez amerykańską agencję kosmiczną NASA w ramach programu Voyager. Rozpoczęcie lotu zbiegło się w czasie z bardzo korzystnym położeniem planet, które umożliwiło odwiedzenie wszystkich gazowych olbrzymów: Jowisza, Saturna, Urana i Neptuna przez jeden próbnik. Z początku zadaniem misji było dokładne zbadanie Jowisza oraz Saturna, jednak sonda sprawowała się na tyle dobrze, że przeprogramowano ją, aby przeprowadziła badania również pozostałych planet zewnętrznych. Voyager 2 przesłał obrazy wszystkich czterech planet, ich księżyców i pierścieni. Jest jedyną sondą, która dotarła zarówno do Urana i Neptuna.\r\n	Po zakończeniu eksploracji planet, głównym zadaniem misji jest badanie krańcowych obszarów heliosfery oraz pomiar właściwości fizycznych przestrzeni międzygwiezdnej. Od września 2007 roku sonda znajdowała się w obszarze płaszcza Układu Słonecznego. W listopadzie 2018 roku Voyager 2 przekroczył heliopauzę i znalazł się w przestrzeni międzygwiezdnej. Przewiduje się, że zasilanie w energię elektryczną wystarczy do utrzymania funkcjonowania sondy i łączności z Ziemią do około 2025 roku.</p>\r\n</div>\r\n<div>\r\n	<h1>Przebieg misji</h1>\r\n	<img src=\"image/voyager2.jpg\"><p>Start sondy Voyager 2 nastąpił 20 sierpnia 1977 roku. Najpotężniejsza ówczesna amerykańska rakieta nośna Titan 3E z dodatkowym stopniem na stały materiał pędny wyniosła sondę na prowadzącą ku Jowiszowi orbitę o peryhelium wynoszącym 1,0 au i aphelium 6,28 au. Wkrótce po starcie wystąpiły problemy podczas aktywacji urządzeń sondy. Brak było potwierdzenia, że wysięgnik naukowy został wyprostowany i zablokowany w prawidłowej pozycji. Późniejsze testy potwierdziły prawidłową pozycję wysięgnika, błędnie natomiast działał czujnik jego położenia. Wystąpiły też problemy z komputerowym systemem sterowania sondy, co zmusiło inżynierów do jego przeprogramowania.\r\n\r\n	15 grudnia 1977 roku Voyager 2 został prześcignięty przez wystrzeloną szesnaście dni później, ale wprowadzoną na szybszą trajektorię, sondę Voyager 1. W tym momencie wzajemna odległość między sondami wynosiła 17 mln km.\r\n\r\n	6 kwietnia 1978 roku doszło do awarii głównego odbiornika radiowego sondy. Komputer pokładowy przełączył odbiornik na zapasowy, który jednak okazał się uszkodzony - niesprawny był kondensator obwodu strojenia. Awaria ta groziła utratą całej misji i inżynierom z Jet Propulsion Laboratory zajęło kilka miesięcy opracowanie procedur umożliwiających sprawne przesyłanie rozkazów na sondę.\r\n\r\n	<h2>Jowisz</h2>\r\n\r\n	Trajektoria przelotu Voyagera 2 przez układ Jowisza\r\n	24 kwietnia 1979 roku Voyager 2 zaczął wykonywać pierwsze fotografie Jowisza, tworzące film ukazujący cyrkulację atmosferyczną planety. 2 lipca sonda osiągnęła granice jowiszowej magnetosfery.\r\n\r\n	8 lipca 1979 roku sonda zbliżyła się do księżyca Kallisto na odległość 214 930 km. 9 lipca, zbliżając się do Jowisza, sonda przeleciała kolejno obok Ganimedesa (minimalna odległość 62 130 km), Europy (205 720 km) i Amaltei (558 370 km). Największe zbliżenie do Jowisza miało miejsce 9 lipca o 22:29:01 UTC, w odległości 721 670 km od centrum planety, około 650 000 km od szczytów chmur. Tego samego dnia, oddalając się od planety, sonda w dużej odległości (1 129 900 km) minęła Io.\r\n\r\n	3 sierpnia Voyager 2 opuścił obszar magnetosfery Jowisza, a 5 sierpnia 1979 roku zakończona została faza obserwacji planety. Dokonany podczas przelotu obok Jowisza manewr asysty grawitacyjnej oraz wykonany zaledwie w 2 godziny po największym zbliżeniu do planety manewr korekcji trajektorii, zmieniły orbitę sondy na prowadzącą do Saturna orbitę hiperboliczną.\r\n\r\n	Trajektoria Voyagera 2 została tak dobrana, żeby umożliwić bliski przelot obok Europy, która nie była obserwowana z bliska przez sondę Voyager 1. Odkrycia dokonane przez Voyagera 1 spowodowały też, że wprowadzono zmiany w programie przelotu Voyagera 2: przeprowadzono serie obserwacji nowo odkrytych pierścieni planety, aktywności wulkanicznej na Io oraz zórz i wyładowań atmosferycznych na nocnej stronie Jowisza. Na podstawie wyglądu powierzchni Europy wysunięto przypuszczenie, że pod jej stosunkowo cienką skorupą może znajdować się ocean ciekłej wody. Na przekazanych przez sondę zdjęciach odkryto także niewielki księżyc Adrastea.</p>\r\n</div>', 1),
(2, 'usa', '<div>\r\n<h2>Widok o wczesnym poranku 9 listopada 1967</h2>\r\n<img src=\"image/USA1.jpg\" alt=\"Apollo 4 umieszczony na rakiecie Saturn V\" >\r\n<p>\r\nNa wyrzutnię A kompleksu nr 39 na terenie Kennedy Space Center<br/>\r\nukazujący Apollo 4 umieszczonego na rakiecie Saturn V (statek kosmiczny 017/rakieta Saturn 501) przed startem,<br/>\r\nktóry miał miejsce tego samego dnia. Był to pierwszy start rakiety Saturn V.<br/>\r\nJest to początek jednego z najważniejszych programów NASA,<br/>\r\njakie do tej pory miały miejsce.\r\n</p>\r\n</div>\r\n<div>\r\n<h2>Ares I</h2>\r\n<img src=\"image/USA4.jpg\">\r\n<p>\r\nAnulowanego Programu Constellation projekt rakiety nośnej dla pojazdu kosmicznego Orion.<br/>\r\nBył poprzednio znany pod nazwą Crew Launch Vehicle (ang. Pojazd Wynoszący Załogę) lub oznaczany skrótem CLV.<br/>\r\nOtrzymał też nieoficjalną nazwę \"The Stick\", czyli \"Kijek\", w związku ze swoim dość wysmukłym kształtem.<br/>\r\nW czerwcu 2006 r. NASA oficjalnie nadała pojazdowi nazwę Ares I.<br/>\r\nAres odnosi się do greckiego boga wojny, którego rzymskim odpowiednikiem jest Mars.<br/>\r\nTym sposobem, nazwa pojazdu nawiązuje do planowanych przez NASA wypraw na Marsa.<br/>\r\nRzymska cyfra \"I\" jest nawiązaniem do rakiet Saturn I i Saturn IB, wykorzystywanych przez NASA w programie Apollo.<br/>\r\nZaznaczony symbolicznie w logo rakiety wschód Słońca miał podkreślać początek nowej epoki podboju kosmosu.<br/>\r\nDziesięć gwiazd symbolizuje centra NASA,<br/>\r\na strzelający ku górze promień stanowi alegorię dążenia ku nieznanemu i potęgę ludzkiej wyobraźni.\r\n</p>\r\n</div>\r\n<div>\r\n<h2>Antares (znana wcześniej jako Taurus 2) – rakieta nośna</h2>\r\n<img src=\"image/USA3.jpg\">\r\n<h3>Budowa</h3>\r\n<p>\r\nRakieta Antares (w wariantach 110 i 120)<br/>\r\nw pierwszym stopniu wykorzystuje dwa silniki AJ26-62,<br/>\r\nbędące modyfikacją radzieckich silników NK-33,<br/>\r\nw których materiałem pędnym jest nafta i ciekły tlen.<br/> \r\nStopień ten ma długość 27,6 m, a zbiornik na paliwo produkowany jest przez ukraińskie zakłady Jużmasz.<br/>\r\nWariant 230, wprowadzony w 2016, wykorzystuje rosyjskie silniki RD-181.<br/>\r\nDrugi stopień napędzany jest silnikami Castor 30 na paliwo stałe i występuje w dwóch wariantach: 30A/B o długości 3,5 m i 30XL o długości ok. 6 m.<br/>\r\nOpcjonalnie można wykorzystać dwa rodzaje trzeciego stopnia.<br/>\r\nPierwszy (ATK STAR 48BV na paliwo stałe) jest oparty na Star-48, natomiast drugi (BTS) jest napędzany hydrazyną.\r\n</p>\r\n</div>\r\n<div>\r\n<h2>Atena (znana także jako LLV – Lockheed Launch Vehicle i LMLV – Lockheed Martin Launch Vehicle)</h2>\r\n<img src=\"image/USA5.jpg\">\r\n<p>\r\nAmerykańska rakieta budowana z funduszy prywatnych przez firmę Lockheed,<br/> a następnie przez Lockheed Martin.\r\n</p>\r\n</div>', 1),
(3, 'zsrr', '<div>\r\n	<h2><i>Angara</i></h2>\r\n	<p>\r\n		Rodzina rosyjskich rakiet nośnych, które mają zastąpić dotychczas wykorzystywane rakiety: Sojuz, Proton, Zenit i Rokot.<br/>\r\n	<img src=\"image/zsrr1.jpg\" >\r\n		Prace nad nią prowadzi Państwowe Produkcyjno-Badawcze Centrum Kosmiczne im. M. Chruniczewa.<br/>\r\n		Pierwszy udany start rakiety z rodziny Angara odbył się 9 lipca 2014 roku z kosmodromu Plesieck.<br/>\r\n		Był to lot suborbitalny wariantu Angara-1.2PP złożonego z komponentów rakiet Angara-1 i Angara-A3/5.<br/>\r\n		23 grudnia miał miejsce udany start rakiety Angara-A5 z kosmodromu Plesieck\r\n		Docelowo podstawowe rakiety Angara mają startować z kosmodromu Plesieck.<br/>\r\n		Warianty najcięższe z kosmodromów Bajkonur i Plesieck, a w przyszłości także z nowego kosmodromu Wostocznyj.\r\n	</p>\r\n</div>\r\n<div>\r\n	<h2><i>N1</i></h2>\r\n	<img src=\"image/zsrr2.jpg\">\r\n	<h3>Konstrukcja i historia</h3>\r\n	<p>\r\n		Nowa rakieta Korolowa została oznaczona N1; w połowie 1962 roku jej projekt nadawał się już do pokazania Kremlowi.<br/>\r\n		Projekt starannie przejrzała komisja pod kierunkiem Mstisława Kiełdysza.<br/>\r\n		N1 była rakietą porównywalną z amerykańskimi rakietami Saturn V.\r\n		Liczyła ponad 100 metrów wysokości i miała moc wystarczającą do wyniesienia 95 ton na niską orbitę okołoziemską.<br/>\r\n		Jej zadaniem miało być także umożliwienie załogowego lądowania na Księżycu.<br/>\r\n		Korolow pierwotnie zamierzał przetransportować oddzielnymi rakietami dwie lub trzy części księżycowego statku,\r\n		który kosmonauci zmontowaliby na orbicie okołoziemskiej,\r\n		później jednak również i on doszedł do koncepcji połączenia pojazdów na orbicie księżycowej.\r\n		Pojedyncza N1 wystarczała do dostarczenia na orbitę Księżyca dwuosobowego statku,\r\n		który wysłałby potem na powierzchnię Księżyca mały lądownik z samotnym kosmonautą,\r\n		poczekał na niego i wrócił na Ziemię. Biorąc pod uwagę to,\r\n		że olbrzymi obszar ZSRR miał w zasadzie granice lądowe,\r\n		jeśli nie liczyć Oceanu Arktycznego i mniejszych akwenów,\r\n		nie było możliwości budowania wielkich stopni N1 daleko od ośrodka,\r\n		z którego miały odbywać się starty, i transportu ich barkami.\r\n		Fabryka została więc zbudowana w Tiuratam - miała tam powstawać cała N1.\r\n		Silniki Kuźniecowa będą pochodziły z Kujbyszewa,\r\n		a wszystkie trzy stopnie rakiety zmontuje się w jednym zakładzie,cały czas w pozycji poziomej.\r\n	</p>\r\n	<br/>\r\n</div>\r\n<div>\r\n	<h2><i>Proton</i></h2>\r\n	<img src=\"image/zsrr3.jpg\">\r\n	<h3>Warianty rakiet Proton</h3>\r\n	<li>Proton – wczesna wersja (8K82)</li>\r\n	<li>Proton K (8K82K)</li>\r\n	<li>Proton M (8K82KM)</li>\r\n	<p>\r\n		 rosyjska rakieta nośna (formalne oznaczenie UR-500) produkcji Zakładów im.<br/>\r\n		 Chruniczewa w Moskwie. Po raz pierwszy została zastosowana w 1965 r.<br/>\r\n		 Rakieta może wynieść na niską orbitę okołoziemską 20-tonowy ładunek.<br/>\r\n		 Paliwem jest toksyczny UDMH, czyli niesymetryczna dimetylohydrazyna.\r\n	</p>\r\n</div>\r\n<div>\r\n	<h2><i>Sojuz 11A511</i></h2>\r\n	<img src=\"image/zsrr4.jpg\">\r\n	<h3>Dane techniczne</h3>\r\n	<p>\r\n		Rakieta Sojuz była trzecią modyfikacją pocisku R-7 przeznaczoną do lotów załogowych\r\n		(po rakietach dla statków Wostok i Woschod). Wysokość rakiety wynosiła 46 metrów,\r\n		zaś średnica (1 człon i 4 bloki boczne) 10 m. Udźwig rakiety na niską orbitę okołoziemską wynosił 6,5 t.\r\n		Rakieta posiadała dwa stopnie. Podobnie jak inne rakiety typu R-7\r\n		ta również nie mogła startować z pomocą jednego członu, gdyż silnik RD-108 (ciąg 977 kN) był zbyt słaby,\r\n		by rakieta mogła oderwać się od ziemi. Stąd użyto czterech bocznych bloków,\r\n		z 4 silnikami RD-107 każdy o ciągu 944 kN. \r\n		W drugim członie użyto silnika RD-0110 wytwarzającego ciąg 294 kN,\r\n		co wystarczało do ostatecznej korekcji orbity. Materiałami pędnymi była mieszanina RG-1 i ciekłego tlenu.\r\n	</p>\r\n</div>', 1),
(4, 'chiny', '<div>\r\n	<h1>Chang Zheng 2D</h1>\r\n	<img src=\"image/chiny1.jpg\"><p> Chińska dwustopniowa rakieta nośna, oparta o dwa pierwsze człony rakiety Długi Marsz 4. Oba człony wykorzystują dwuskładnikowe przechowywalne ciekłe mieszanki paliwowe: tetratlenek diazotu i UDMH. Rakieta może zostać wyposażona w dwa rodzaje osłon balistycznych ładunku:</p>\r\n</div>\r\n<div>\r\n	<h1>Długi Marsz 7</h1>\r\n	<img src=\"image/chiny2.jpg\"><p>Opracowana w latach 2008-2016 i wykorzystywana od 2016 roku chińska rakieta nośna o średnim udźwigu zasilana paliwem ciekłym. Bazuje ona na rakiecie Długi Marsz 2F, jednak w przeciwieństwie do niej nie używa hipergolowej mieszanki UDMH/N<sub>2</sub>O<sub>4</sub>, lecz mieszanki ciekłego tlenu i nafty lotniczej, co zmniejszy ryzyko skażenia terenu w przypadku awarii. Wykorzystuje silniki zaprojektowane dla ciężkiej rakiety Długi Marsz 5 (te same silniki mają być też wykorzystane w rakiecie Długi Marsz 6, która ma mieć niski udźwig).\r\n\r\n	Długi Marsz 7 będzie wykorzystywana dla statków załogowych Shenzhou oraz pojazdów dostawczych Tianzhou (bazujących na module Tiangong 1) umieszczanych na niskiej orbicie okołoziemskiej w celu połączenia z nową wielomodułową stacją kosmiczną, której budowa jest planowana w latach 2018-2020.\r\n\r\n	Pierwszy lot rakiety Długi Marsz 7 odbył się 25 czerwca 2016. Rakieta wystartowała z powodzeniem z platformy startowej LC-2 w kosmodromie Wenchang, wynosząc na niską orbitę okołoziemską makietę załogowej kapsuły powrotnej oraz kilka satelitów. Był to zarazem pierwszy start rakiety z tego nowego kosmodromu na wyspie Hajnan.</p>\r\n</div>\r\n<div>\r\n	<h1>Długi Marsz 6</h1>\r\n	<img src=\"image/chiny3.jpg\">\r\n	<p>\r\n	 Chińska lekka trzystopniowa rakieta nośna na paliwo ciekłe, służąca do wynoszenia na orbitę wokółziemską mniejszych obiektów. Rakieta wynosi ok. 1500 kg na niską orbitę okołoziemską (LEO). Pierwszy start odbył się 20 września 2015 r. z kosmodromu Taiyuan.\r\n	</p>\r\n</div>', 1),
(6, 'filmy', '<div>\r\n	<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/v1RfDc9RZc0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n<div>\r\n	<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/SlsrNS8ANr8\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n<div>\r\n	<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/rrOgZnBrjXs\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `data_utworzenia` date NOT NULL,
  `data_modyfikacji` date NOT NULL,
  `data_wygasniecia` date NOT NULL,
  `cena_netto` float NOT NULL,
  `podatek_vat` int(11) NOT NULL,
  `ilosc_dostepnych` int(11) NOT NULL,
  `status_dostepnosc` tinyint(1) NOT NULL,
  `kategoria` int(11) NOT NULL,
  `gabaryt_produktu` float NOT NULL,
  `zdjecie` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_dostepnych`, `status_dostepnosc`, `kategoria`, `gabaryt_produktu`, `zdjecie`) VALUES
(1, 'RTX 3080', 'Karta z najwyższej półki cenowej', '2022-01-23', '2022-01-23', '2022-01-31', 8000.24, 23, 1, 1, 5, 3.7, 'image/RTX_3080.jpg'),
(2, 'RTX 3070', 'Karta z najwyższej półki cenowej', '2022-01-26', '2022-01-26', '2022-01-31', 6500.89, 0, 3, 1, 5, 2.4, 'image/RTX_3070.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
