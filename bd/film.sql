-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 fév. 2024 à 17:52
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `duree` int(11) NOT NULL,
  `resume` text NOT NULL,
  `date_sortie` date NOT NULL,
  `pays` varchar(50) NOT NULL,
  `lien_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `titre`, `duree`, `resume`, `date_sortie`, `pays`, `lien_image`) VALUES
(1, 'Forest Gump', 140, 'Quelques décennies d\'histoire américaine, des années 1940 à la fin du XXème siècle, à travers le regard et l\'étrange odyssée d\'un homme simple et pur, Forrest Gump.', '1994-10-05', 'Etats-Unis', 'https://placehold.co/250x250?text=Forrest+Gump'),
(2, 'Fury', 134, 'Avril 1945. Les Alliés mènent leur ultime offensive en Europe. À bord d’un tank Sherman, le sergent Wardaddy et ses quatre hommes s’engagent dans une mission à très haut risque bien au-delà des lignes ennemies. Face à un adversaire dont le nombre et la puissance de feu les dépassent, Wardaddy et son équipage vont devoir tout tenter pour frapper l’Allemagne nazie en plein cœur…', '2014-10-22', 'Etats-Unis', 'https://placehold.co/250x250?text=Fury'),
(3, 'Tu ne tueras point', 140, 'Quand la Seconde Guerre mondiale a éclaté, Desmond, un jeune américain, s’est retrouvé confronté à un dilemme : comme n’importe lequel de ses compatriotes, il voulait servir son pays, mais la violence était incompatible avec ses croyances et ses principes moraux. Il s’opposait ne serait-ce qu’à tenir une arme et refusait d’autant plus de tuer.\r\nIl s’engagea tout de même dans l’infanterie comme médecin. Son refus d’infléchir ses convictions lui valut d’être rudement mené par ses camarades et sa hiérarchie, mais c’est armé de sa seule foi qu’il est entré dans l’enfer de la guerre pour en devenir l’un des plus grands héros. Lors de la bataille d’Okinawa sur l’imprenable falaise de Maeda, il a réussi à sauver des dizaines de vies seul sous le feu de l’ennemi, ramenant en sureté, du champ de bataille, un à un les soldats blessés.', '2016-11-09', 'Etats-Unis', 'https://placehold.co/250x250?text=Tu+ne+tueras+points'),
(4, 'Fast & Furious 7', 137, 'Dominic Toretto et sa \"famille\" doivent faire face à Deckard Shaw, bien décidé à se venger de la mort de son frère.', '2015-04-01', 'Etats-Unis', 'https://placehold.co/250x250?text=Fast+&+Furious+7'),
(5, 'Very Bad Trip', 90, 'Au réveil d\'un enterrement de vie de garçon bien arrosé, les trois amis du fiancé se rendent compte qu\'il a disparu 40 heures avant la cérémonie de mariage. Ils vont alors devoir faire fi de leur gueule de bois et rassembler leurs bribes de souvenirs pour comprendre ce qui s\'est passé.', '2009-06-24', 'Etats-Unis', 'https://placehold.co/250x250?text=Very+Bad+Trip'),
(6, 'Fatal', 95, 'Fatal... c\'est Fatal Bazooka, un rappeur bling-bling et hardcore. En fait, un personnage de sketch créé par Michaël Youn dans son show-télé \"Morning Live\", puis développé dans l\'album \"T\'as vu\" vendu à plus de 500 000 exemplaires. Ce film raconte ce que serait devenu ce rappeur s\'il en avait vendu... 15 millions ! Fatal est désormais une énorme star. Des millions de fans, des dizaines de tubes, 4 Music Awards de la Musique du meilleur artiste de l\'année, une ligne de vêtements, un magazine et prochainement l\'ouverture de son propre parc d\'attraction : Fataland. Il est le N°1 incontesté. En apparence tout va bien... mais en réalité, Fatal ne sait plus où il va, parce qu\'il ne sait plus d\'où il vient : depuis ses débuts, il fait croire qu\'il a grandi dans le ghetto... alors qu\'en fait, il est né dans un petit village de Savoie, en plein coeur des Alpes. Mais on ne peut pas être un \"gansta\" quand on est un fils de bergers de Savoie, alors Fatal a préféré cacher ses origines et oublier son passé...', '2010-06-16', 'France', 'https://placehold.co/250x250?text=Fatal'),
(7, 'Seul sur Mars', 154, 'Lors d’une expédition sur Mars, l’astronaute Mark Watney (Matt Damon) est laissé pour mort par ses coéquipiers, une tempête les ayant obligés à décoller en urgence. Mais Mark a survécu et il est désormais seul, sans moyen de repartir, sur une planète hostile. Il va devoir faire appel à son intelligence et son ingéniosité pour tenter de survivre et trouver un moyen de contacter la Terre. A 225 millions de kilomètres, la NASA et des scientifiques du monde entier travaillent sans relâche pour le sauver, pendant que ses coéquipiers tentent d’organiser une mission pour le récupérer au péril de leurs vies.', '2015-10-21', 'Etats-Unis', 'https://placehold.co/250x250?text=Seul+sur+Mars'),
(8, 'Interstellar', 169, 'Le film raconte les aventures d’un groupe d’explorateurs qui utilisent une faille récemment découverte dans l’espace-temps afin de repousser les limites humaines et partir à la conquête des distances astronomiques dans un voyage interstellaire. ', '2014-11-05', 'Etats-Unis', 'https://placehold.co/250x250?text=Interstellar'),
(9, 'Titanic', 194, 'Southampton, 10 avril 1912. Le paquebot le plus grand et le plus moderne du monde, réputé pour son insubmersibilité, le \"Titanic\", appareille pour son premier voyage. Quatre jours plus tard, il heurte un iceberg. A son bord, un artiste pauvre et une grande bourgeoise tombent amoureux.', '1998-01-07', 'Etats-Unis', 'https://placehold.co/250x250?text=Titanic'),
(10, 'Creed 3', 117, 'Idole de la boxe et entouré de sa famille, Adonis Creed n’a plus rien à prouver. Jusqu’au jour où son ami d’enfance, Damian, prodige de la boxe lui aussi, refait surface. A peine sorti de prison, Damian est prêt à tout pour monter sur le ring et reprendre ses droits. Adonis joue alors sa survie, face à un adversaire déterminé à l’anéantir.', '2023-03-01', 'Etats-Unis', 'https://placehold.co/250x250?text=Creed+3'),
(11, 'Avatar la Voie de l\'Eau', 192, 'Se déroulant plus d’une décennie après les événements relatés dans le premier film, AVATAR : LA VOIE DE L’EAU raconte l\'histoire des membres de la famille Sully (Jake, Neytiri et leurs enfants), les épreuves auxquelles ils sont confrontés, les chemins qu’ils doivent emprunter pour se protéger les uns les autres, les batailles qu’ils doivent mener pour rester en vie et les tragédies qu\'ils endurent.', '2022-12-14', 'Etats-Unis', 'https://placehold.co/250x250?text=Avatar+la+voie+de+l\'Eau'),
(12, 'Fight Club', 139, 'Le narrateur, sans identité précise, vit seul, travaille seul, dort seul, mange seul ses plateaux-repas pour une personne comme beaucoup d\'autres personnes seules qui connaissent la misère humaine, morale et sexuelle. C\'est pourquoi il va devenir membre du Fight club, un lieu clandestin ou il va pouvoir retrouver sa virilité, l\'échange et la communication. Ce club est dirigé par Tyler Durden, une sorte d\'anarchiste entre gourou et philosophe qui prêche l\'amour de son prochain.\r\n\r\n', '1999-11-10', 'Etats-Unis', 'https://placehold.co/250x250?text=Fight+Club'),
(13, 'Dunkerque', 107, 'Le récit de la fameuse évacuation des troupes alliées de Dunkerque en mai 1940.\r\n\r\n', '2017-08-17', 'Angleterre', 'https://placehold.co/250x250?text=Dunkerque'),
(14, 'Le voyage de Chihiro', 126, 'Chihiro, 10 ans, a tout d’une petite fille capricieuse. Elle s’apprête à emménager avec ses parents dans une nouvelle demeure. Sur la route, la petite famille se retrouve face à un immense bâtiment rouge au centre duquel s’ouvre un long tunnel. De l’autre côté du passage se dresse une ville fantôme. Les parents découvrent dans un restaurant désert de nombreux mets succulents et ne tardent pas à se jeter dessus. Ils se retrouvent alors transformés en cochons. Prise de panique, Chihiro s’enfuit et se dématérialise progressivement. L’énigmatique Haku se charge de lui expliquer le fonctionnement de l’univers dans lequel elle vient de pénétrer. Pour sauver ses parents, la fillette va devoir faire face à la terrible sorcière Yubaba, qui arbore les traits d’une harpie méphistophélique.', '2002-04-10', 'Japon', 'https://placehold.co/250x250?text=Le+voyage+de+Chihiro'),
(15, 'Les Visiteurs', 105, 'En l\'an de grace 1123, le comte de Montmirail et son fidèle écuyer, Jacquouille la Fripouille, se retrouvent propulsés en l\'an 1992 apres avoir bu une potion magique fabriquée par l\'enchanteur Eusaebius, censée leur permettre de se défaire d\'un terrible sort.', '1993-01-27', 'France', 'https://placehold.co/250x250?text=Les+Visiteurs'),
(16, 'Les Blancs ne savent pas sauter', 101, 'Jeremy est une ancienne star du streetball dont les blessures successives ont définitivement mis fin à sa carrière. Kamal est un joueur prometteur qui a de lui-même compromis son propre avenir dans le sport. Jonglant entre relations précaires, pressions financières et conflits internes, les deux « ballers » - de prime abord foncièrement différents – vont peu à peu découvrir qu\'ils ont bien plus en commun qu\'ils ne l\'imaginaient...', '2023-05-19', 'Etats-Unis', 'https://placehold.co/250x250?text=Les+blancs+ne+savent+pas+sauter'),
(17, 'Gran Turismo', 134, 'Gran Turismo retrace l\'incroyable histoire vraie d\'une équipe d\'outsiders : un gamer issu de la classe ouvrière, un ex-pilote de course raté et un cadre idéaliste de l’industrie du sport automobile. Ensemble, ils risquent tout et s\'attaquent au sport le plus élitiste au monde.\r\n\r\nInspirant, palpitant et bourré d’action, le film GRAN TURISMO prouve que rien n\'est impossible quand on est déterminé à prendre tous les risques.', '2023-08-09', 'Etats-Unis', 'https://placehold.co/250x250?text=Gran+Turismo'),
(18, 'Coach Carter', 137, 'L\'histoire vraie de Ken Carter, l\'entraîneur de basket d\'une équipe de lycée, qui devint célèbre en 1999 après avoir renvoyé ses joueurs à leurs chères études, déclarant forfait deux matchs de suite alors que l\'équipe était invaincue, parce que ces derniers n\'avaient pas obtenu des résultats scolaires suffisants.', '2005-08-17', 'Etats-Unis', 'https://placehold.co/250x250?text=Coach+Carter'),
(19, 'Le Mans 66', 153, 'Basé sur une histoire vraie, le film suit une équipe d\'excentriques ingénieurs américains menés par le visionnaire Carroll Shelby et son pilote britannique Ken Miles, qui sont envoyés par Henry Ford II pour construire à partir de rien une nouvelle automobile qui doit détrôner la Ferrari à la compétition du Mans de 1966.', '2019-11-13', 'Etats-Unis', 'https://placehold.co/250x250?text=Le+Mans+66'),
(20, 'Ça', 124, 'À Derry, dans le Maine, sept gamins ayant du mal à s\'intégrer se sont regroupés au sein du \"Club des Ratés\". Rejetés par leurs camarades, ils sont les cibles favorites des gros durs de l\'école. Ils ont aussi en commun d\'avoir éprouvé leur plus grande terreur face à un terrible prédateur métamorphe qu\'ils appellent \"Ça\"…\r\n\r\nCar depuis toujours, Derry est en proie à une créature qui émerge des égouts tous les 27 ans pour se nourrir des terreurs de ses victimes de choix : les enfants. Bien décidés à rester soudés, les Ratés tentent de surmonter leurs peurs pour enrayer un nouveau cycle meurtrier. Un cycle qui a commencé un jour de pluie lorsqu\'un petit garçon poursuivant son bateau en papier s\'est retrouvé face-à-face avec le Clown Grippe-Sou …', '2017-09-20', 'Etats-Unis', 'https://placehold.co/250x250?text=ça');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
