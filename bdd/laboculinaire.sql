-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 08 oct. 2019 à 11:43
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `laboculinaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `id` int(11) NOT NULL,
  `intitule` varchar(150) NOT NULL,
  `accroche` varchar(300) NOT NULL,
  `duree` tinyint(4) NOT NULL,
  `nbPersonnesMin` tinyint(4) NOT NULL,
  `nbPersonnesMax` tinyint(4) NOT NULL,
  `prixParPersonne` decimal(10,2) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `intitule`, `accroche`, `duree`, `nbPersonnesMin`, `nbPersonnesMax`, `prixParPersonne`, `idCategorie`, `description`) VALUES
(1, 'Atelier Macarons', '« The » macarons', 2, 8, 11, '59.00', 5, 'Réussir des macarons… ça ne s’improvise pas !\r\n\r\nSymbôle de la pâtisserie parisienne, n\'est pas français celui qui n\'a pas tenté au moins une fois de réaliser ces migniardises qui font notre renomée.\r\n\r\nSuite à cet atelier, vous ferez fureur lors d\'un gôuter ou à offrir. Et rien à envier à Ladurée !\r\n\r\nDeux types de macarons,  _au nombre de 8 environ_, seront confectionnés lors de votre cours de cuisine :\r\n\r\n-   **Ganache citron**\r\n-   **Ganache chocolat**\r\n\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(2, 'Cupcakes', 'Des cupcakes comme à la maison !', 2, 8, 12, '59.00', 5, 'Les cupcakes sont les pâtisseries à la mode par excellence.\r\n\r\nPas une célébration ne se fait sans ces gâteuax individuels, que l\'on a plaisir à confectionner de toutes les couleurs, et à tous les goûts.\r\n\r\nNutella, Red Velvet, citron, café, sans oublier le glaçage et les toppings !\r\n\r\nVenez apprendre à réaliser ces petites merveilles gustatives en suivant les conseils avisés de notre chef pâtissier.\r\n\r\nVous découvrirez :\r\n\r\n-   **Réalisation d\'une pâte à cupcake**\r\n-   **Cuisson optimale d\'un cupcake**\r\n-   **Utilisation d\'une poche à douille**\r\n-   **Réalisation de plusieurs topping, glaçage...**\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(3, 'Sushi4you', 'Un rouleau bien garni', 2, 8, 14, '59.00', 2, 'Vous avez toujours rêvé d\'ajouter l\'art du sushi à votre palette de cuisinier amateur du samedi soir ?\r\n\r\nLe Labo Culinaire vous propose un cours dédié à l\'apprentissage des techniques spécifiques à la réalisation de ces fameuses bouchées japonaises...\r\n\r\nDans un ambiance conviviale, accompagnés par notre sushiman, vous apprendrez la découpe du saumon, la préparation et cuisson du riz japonais et l\'utilisation de la natte japonaise. Mais attention, attitude sérieuse exigée !\r\n\r\nTout ceci pour réaliser les recettes suivantes :\r\n\r\n-   **5 sushi nigiri**\r\n-   **6 maki**\r\n-   **6 california**\r\n-   **6 californias sans algue**\r\n\r\nTous ces rouleaux à plein de trucs de la mer sont facilement faisables chez soi, mais pas avant d\'avoir réservé un cours au Labo Culinaire !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(4, 'Atelier bouchées moléculaires', 'Réveillez l\'apprenti chimiste qui sommeille en vous !', 2, 8, 12, '59.00', 3, 'Les molécules, H20, les lois de l\'attraction terrestre... et non, nous ne vous proposons pas un retour sur les bancs de l\'école, mais plutôt de vous approprier les lois de la physique chimie en cuisine.\r\n\r\nLors de ce cours, vous apprendrez quelques techniques de cuisine moléculaire simples. Il est possible de les reproduire chez soi, après avoir reçu une introduction et observé les démonstrations avisées de notre chef !\r\n\r\nEt voici le programme :\r\n\r\n-   **Sphérification classique** lors de la réalisation d\'un célèbre cocktail alcoolisé !\r\n-   **Sphérification inverse** avec la réalisation d\'une bouchée à la tomate mozzarella et autre bouchée surprise\r\n-   Démonstration du chef d\'un sorbet réalisé avec **l\'azote liquide**\r\n-   Dégustation minute de ces créations surprenantes !\r\n\r\nEt ce n\'est pas tout ... Allez venez, c\'est par ici que ça se passe ;)\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier se dégustent au fur et à mesure_\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(5, 'Cuisine moléculaire gourmande', 'Un spectacle surprenant et original !', 2, 8, 12, '59.00', 3, 'Vous ne savez plus comment surprendre vos invités lorsque vous recevez chez vous ?\r\n\r\nVenez réaliser un menu complet de cuisine moléculaire, qui saura étonner l’ensemble de vos convives lors de votre prochaine soirée.\r\n\r\nAccompagnés de notre chef, vous découvrirez les techniques et astuces de cette cuisine originale, et réaliserez le menu suivant :\r\n\r\n-   **Entrée :** Espuma pommes de terre accompagné de son fromage express\r\n-   **Plat :** Dorade ou rouget au feu et son caviar de saveurs, courgettes marinées au basilic et air d’orange\r\n-   **Dessert :** Glace 2.0 mascarpone, gel de café et granita de framboise\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(6, 'Fraîcheurs gourmande ', 'Découvrez, apprenez... Et dégustez !!', 3, 8, 14, '89.00', 3, 'Accompagnés de notre spécialiste de la cuisine moléculaire, réalisez un menu complet, frais et épatant ... et partagez-le avec le reste de l\'équipe !\r\n\r\nCet atelier vous permettra d\'aborder les techniques les plus populaires et simples à réaliser de cette cuisine peu commune.\r\n\r\nSphérification inversée, fumage à froid, délification.. autant de procédés que vous mettrez en application dans la réalisation du menu suivant :\r\n\r\n-   **Entrée :** Espuma vitelote de pommes de terre accompagné de son fromage express\r\n-   **Plat :**  Bonite ou dorade au feu, thé géométrique aux herbes, poivrons sautés et air à l’orange\r\n-   **Dessert :** Eponge gourmande, sorbet de mascarpone et granita de fruit, et sa Meringue azotée avec « Effet Dragon »\r\n\r\nPar la suite, n\'hésitez pas à partager vos impressions et faire connaissance avec le reste du groupe, et régalez-vous !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 3 heures seront à déguster sur place avec le groupe._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(7, 'Cuisine marocaine', 'Le vrai couscous méditerranéen !', 2, 8, 12, '59.00', 4, 'Inutile de vous rendre à Marrakech pour découvrir le vrai couscous méditerranéen !\r\n\r\nVenez apprendre à le réaliser vous-même, pour satisfaire vos papilles et voyager parmi ses saveurs...\r\n\r\nL\'atelier débutera avec une présentation du cours et de ses ingrédients.Ensuite, les participants apprendront à préparer le contenu, la cuisson du couscous, des légumes, de la viande ainsi que la préparation de la brick et l\'apprentissage du pli de la feuille.\r\n\r\n-   **Entrée :** La feuille de brick\r\n-   **Plat :** Le couscous méditerranéen\r\n-   **Dessert :** Cornes de gazelle\r\n\r\nLe Couscous Méditerranéen n’aura plus aucun secret pour vous.\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(8, 'Gastronomie française', 'La gastronomie ... À la française !', 3, 8, 13, '89.00', 1, 'La gastronomie française est diverse, riche et variée. C\'est ce qui en fait sa renommée à travers le monde. Il est donc essentiel de pouvoir en faire sa connaissance et la maîtriser dans notre propore pays !\r\n\r\nLe Labo Culinaire vous aide à confectionner un menu typique et traditionnel français, qui vous donnera des idées pour le repas de ce soir !\r\n\r\nAvec l\'accompagnement de notre chef, vous vous familiariserez avec la terre et la mer à travers le menu suivant :\r\n\r\n-   **Entrée :**Tartare de saumon assaisonné\r\n-   **Plat :** Magret de canard et son millefeuille de légumes de saison\r\n-   **Dessert :** Strudel aux pommes\r\n\r\nIl vous sera alors facile de resservir ces délicieux mets en famille ou entre amis.\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier se dégusteront sur place !_\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire_\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(9, 'Menu traditionnel', 'La gastronomie ... À la française !', 3, 8, 13, '89.00', 1, 'La gastronomie française est diverse, riche et variée. C\'est ce qui en fait sa renommée à travers le monde. Il est donc essentiel de pouvoir en faire sa connaissance et la maîtriser dans notre propore pays !\r\n\r\nLe Labo Culinaire vous aide à confectionner un menu typique et traditionnel français, qui vous donnera des idées pour le repas de ce soir !\r\n\r\nAvec l\'accompagnement de notre chef, vous vous familiariserez avec la terre et la mer à travers le menu suivant :\r\n\r\n-   **Entrée :**Tartare de saumon assaisonné\r\n-   **Plat :** Magret de canard et son millefeuille de légumes de saison\r\n-   **Dessert :** Strudel aux pommes\r\n\r\nIl vous sera alors facile de resservir ces délicieux mets en famille ou entre amis.\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier se dégusteront sur place !_\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire_\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(10, 'Cuisine portugaise', 'A recette secrète dos pasteis de data ! C\'est ici...', 2, 8, 12, '59.00', 4, 'Un vent de méditerranée souffle dans notre atelier parisien...\r\n\r\nAccueillez le Portugal dans votre cuisine grâce à cet atelier culinaire à base de morue, de sardine, de porc… tant de mets à découvrir et à reproduire chez soi sans modération :\r\n\r\n-   **Entrées :**  Accras de morue (_Rissois de Carne)_\r\n-   **Plat :**  Brandade de Morue (_Carne a Alentejana)_\r\n-   **Dessert :**  Pasteis de Nata\r\n\r\nRégalez-vous avec nos recettes du soleil et le savoir-faire de notre chef portugais !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(11, 'Cuisine italienne', 'Notre cours à l\'italienne', 2, 8, 12, '59.00', 4, 'Venez succomber au charme de notre menu spécial  _Italia_  à Paris  !\r\n\r\nDans mon frigo, j\'ai de la mozarella, de la sauce tomate, du basilic, du jambon... A quoi ça vous fait penser ?\r\n\r\nLors de cet atelier, au lieu de vous entraîner à une pizza traditionnelle, nous découvrirons ensemble menu complet et traditionnel, facile à reproduire chez soi :\r\n\r\n-   **Entrée :** Panzanella Toscana ! salade typique de la région de Florence\r\n-   **Plat :** Ravioli farcie aux saveurs du moment\r\n-   **Dessert :** Pannacotta traditionnelle italienne et son coulis de fruits\r\n\r\nAvec ce cours, notre chef met également les spaghettis de côté !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(12, 'Cuisine libanaise', 'Houmous, falafel, kefta.... Tant à découvrir !', 2, 8, 12, '59.00', 4, 'La succulente cuisine libanaise n\'aura plus de secret pour tous les gourmands, avec son cours sous le signe du Moyent Orient !\r\n\r\nProfitez-en pour vous mettre à jour en réalisant une savoureuse formule complète :\r\n\r\n-   **Mezze :** des falafels, un houmous et des keftas accompagnés de leur sauce yaourt/concombre\r\n-   **Plat :** un tajine de poisson libanais et son moudardara (riz aux lentilles traditionnel)\r\n-   **Dessert :**  les fameux saniouras aux fruits secs et leur thé noir\r\n\r\nPlus qu\'une initiation, un voyage vers de nouvelles saveurs !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(13, 'Atelier trio de tartelettes', 'La pâtisserie, c\'est pas de la tarte !', 2, 8, 12, '59.00', 5, 'Vous sentez cette bonne odeur de chocolat, vous voyez ces fruits disposés avec soin, et ce caramel coulant le long de la spatule ?\r\n\r\nEh oui, il s\'agit bien d\'un atelier de confection de tartelettes sucrées et gourmandes au Labo Culinaire.\r\n\r\nGrâce à leur mini taille, notre chef pâtissier vous propose de réaliser un trio de tartelette entre amis ou en famille et vous confie ses plus belles astuces.\r\n\r\n**Tarte au chocolat, tarte au citron meringuée, tarte aux fruits, tarte au caramel beurre salé, ou encore la tarte des soeurs Tatin**... A chaque occasion sa recette !\r\n\r\n... A chaque occasion sa recette !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(14, 'Atelier cake design', 'La décoration, en pâtisserie aussi !', 2, 8, 12, '59.00', 5, 'Ce cours de Cake Design est l\'occasion à ne pas manquer pour réussir des pâtisseries aussi belles que savoureuses !\r\n\r\nA l\'aide de pâte à sucre, apprenez à sculpter, colorer, habiller et modeler vos créations personelles.\r\n\r\nAucun doute, vous saurez reproduire ces méthodes chez vous pour ravir vos convives lors d\'événements festifs...\r\n\r\nVous apprendrez :\r\n\r\n-   La confection de la génoise qui servira de base de création (**attention, la génoise que vous allez utiliser sera déjà prête afin de respecter les 2h de cours**)\r\n-   L’utilisation (et la découverte) des outils de  **décoration**\r\n-   **Modelage**  de fleurs et objets à la pâte à sucre\r\n-   Travail à la **poche à douille**\r\n-   Travail de la pâte à sucre : apprendre à recouvrir une génoise\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(15, 'Sushi4you végétarien', 'Aux amoureux du poisson cru... Sans poisson !', 2, 8, 12, '59.00', 2, 'Vous avez toujours rêvé d\'ajouter l\'art du sushi à votre palette de cuisinier amateur ?\r\n\r\nLe Labo Culinaire vous propose un cours dédié à l\'apprentissage des techniques spécifiques à la réalisation de ces fameuses bouchées japonaises, adapté à un menu végétarien.\r\n\r\nBase de réalisation :\r\n\r\n-   **5 sushi nigiri**\r\n-   **6 makis**\r\n-   **6 californias**\r\n-   **6 californias sans algue**\r\n\r\nGrâce à nos conseils et astuces, cette gastronomie n\'aura plus aucun secret pour vous !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(16, 'Cuisine Vegan', 'Go vegan !', 2, 8, 12, '59.00', 7, 'Par quoi remplacer les œufs ? Comment apporter suffisamment de protéines ? Aurai-je des carences ?\r\n\r\nCette approche de la nourriture représente un véritable engagement au quotidien...\r\n\r\nLe Labo Culinaire vous propose de répondre à ces questions et de découvrir ensemble quelques recettes pour s’initier à cet art de vivre :\r\n\r\n-   **Entrée :** Velouté de patate douce et de poire avec sa tartine de saison\r\n-   **Plat :** Croquette de fèves et de quinoa au Kale, gingembre et Garam Masala. Garniture de légumes rôtis mono couleur\r\n-   **Dessert :** Crumble Mûres/Myrtilles et chocolat\r\n\r\nNotre cours de cuisine Vegan est idéal pour apprendre cette tendance alimentaire avec des recettes simples et gourmandes.\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(17, 'Street food', 'Un take away, cuisine nomade, des mots pour décrire le « manger sur le pouce »', 2, 8, 12, '59.00', 6, 'À cause d’une pause déj’, d’un budget trop serré, ou encore d’une envie d’un casse-croute, la _street food_ s’invite dans nos habitudes alimentaires au quotidien.\r\n\r\nDécouvrez la street food, une autre manière de manger et de cuisiner.\r\n\r\nRepoussons les frontières et jouons au grand chef à travers ces menus exotiques :\r\n\r\n-   **Entrée :** Tacos de poulet et Salsa\r\n-   **Plat :** Burger LLC\r\n-   **Dessert :** Lassi à la mangue\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(18, 'Choux-choux', 'Chou comme un choux...', 2, 8, 11, '59.00', 5, 'Allez, on a une petite envie de crème pâtissière aujourd\'hui. Mais attention ! pas toute seule (ça fait mal au ventre).\r\n\r\nEt si on vous apprenait à réaliser une pâte à chou et à confectionner de quoi se faire un top dessert ?\r\n\r\nAu menu ce soir :\r\n\r\n-   **Choux à la crème savoureux**\r\n-   **Éclair au crémeux chocolat**\r\n-   **Religieuse au craquelin pralinée**\r\n\r\nEntre amis, en famille ou en solo, vous repartirez avec 3 choux très chics, à déguster sans modération !\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(19, 'Atelier Trivial Pursuit', '1, 2, 3 ... camembert', 2, 10, 20, '59.00', 6, 'Répartis en équipes, vous vous mesurererez au travers d\'une série d\'ateliers culinaires afin de comptabiliser un maximum de points et remporter la victoire.\r\n\r\nRapidité, compétition et dynamisme rythmeront cette activité.\r\n\r\n**Notre selection d\'ateliers :**  \r\n- Quizz  \r\n- Reconnaissance d\'arômes  \r\n- Dégustation à l\'aveugle  \r\n- Montage de mayonnaise...\r\n\r\n**... attention au chronomètre !**'),
(20, 'Maître Sushi', 'Si tu donnes un poisson a un affamé, tu l\'aides pour une journée, mais si tu lui apprends à pêcher, tu l\'aides pour toute sa vie', 3, 8, 13, '89.00', 2, 'Vous rêvez de maîtriser l\'art de la confection des sushis ?\r\n\r\nVenez suivre ce cours complet et technique, où vous apprendrez les plus grands secrets de notre sushiman !\r\n\r\nAu long de ces 3 heures, vous vous perfectionnerez dans la découpe du poisson, la préparation, cuisson et assaisonnement du riz japonais, l\'utilisation de la natte de bambou, et vous pourrez enfin créer votre propres bouchées japonaises :\r\n\r\n-   **6 Makis**\r\n-   **6 californias**\r\n-   **2 tulipes saumon**\r\n-   **2 tulipes avocat**\r\n-   **1 temaki**\r\n\r\nPrécision, concentration et musique d\'ambiance sont au programme. Le tout réalisable chez soi sans aucun...sushi ;)\r\n\r\n&nbsp;\r\n\r\n_Les mets élaborés durant cet atelier de 3 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._'),
(21, 'Atelier de Noël', 'La maison en pain d\'épice', 2, 8, 12, '59.00', 5, '**Noël**  sonne à la porte !\r\n\r\nA cette occasion annuelle, le Labo Culinaire vous propose de passer un moment de fête autour de la confection d\'e la plus épicé des maisons comestibles.\r\n\r\nEt qui sait ? Cela vous donnera sûrement des idées d\'activité en famille pour le 25 décembre.\r\n\r\nAu menu, la réalisation  **d\'une maison en pain d\'épice** à décorer, colorer et surtout... à déguster !\r\n\r\n_Les mets élaborés durant cet atelier de 2 heures seront à emporter._\r\n\r\n_Vous n\'avez rien apporter ! Tout est fourni par Le Labo Culinaire, des tabliers aux emballages pour le transport de vos créations._\r\n\r\n_Le Labo Culinaire se réserve le droit de modifier les recettes indiquées en fonction des aléas du marché des produits frais._\r\n\r\n_Le Labo Culinaire se réserve le droit de reporter un cours de cuisine, notamment à défaut du nombre minimum de participants exigé, aucun remboursement ne sera effectué._');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Cuisine française'),
(2, 'Sushi'),
(3, 'Cuisine moléculaire'),
(4, 'Cuisine du monde'),
(5, 'Pâtisserie'),
(6, 'Cuisine moderne'),
(7, 'Cuisine bien-être');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `genre` enum('homme','femme') DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `actus` tinyint(1) DEFAULT NULL,
  `offres` tinyint(1) DEFAULT NULL,
  `recettes` tinyint(1) DEFAULT NULL,
  `questions` text DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT 0,
  `idOrigine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id`, `genre`, `mail`, `actus`, `offres`, `recettes`, `questions`, `valide`, `idOrigine`) VALUES
(3, 'femme', 'beatrice.bernede@gmail.com', 1, 0, 1, '', 1, 4),
(4, 'femme', 'amandine.prevost@sfr.fr', 1, 1, 1, 'Trop  génial', 0, 3),
(5, 'femme', 'baba@yahoo.fr', 1, 1, 1, '', 0, 8),
(6, 'homme', 'jean-bon@gmail.com', 1, 0, 0, '', 1, 3),
(7, 'homme', 'aurelien.pamart@laposte.net', 1, 1, 1, '', 0, 1),
(8, 'homme', 'pierreomer@sfr.fr', 1, 1, 0, '', 0, 6),
(9, 'femme', 'sandrine-macon@yahoo.fr', 1, 1, 1, 'j\'ai beaucoup aimé votre atelier cuisine hongroise. Prévoyez vous d\'autres ateliers de ce genre ?', 0, 4),
(10, 'homme', 'paulomaley@gmail.com', 1, 0, 0, '', 0, 4),
(11, 'homme', 'ritonseby@sfr.fr', 0, 0, 1, '', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

CREATE TABLE `origine` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `origine`
--

INSERT INTO `origine` (`id`, `libelle`) VALUES
(1, 'En cherchant sur Internet'),
(2, 'Sur Twitter'),
(3, 'Sur Facebook'),
(4, 'Par un(e) ami(e)'),
(5, 'Autre'),
(6, 'Sur un forum'),
(7, 'Lors d\'un salon'),
(8, 'Par email');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'employé');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `idAtelier` int(11) NOT NULL,
  `dateSession` date NOT NULL,
  `heureDebut` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `idAtelier`, `dateSession`, `heureDebut`) VALUES
(1, 1, '2020-01-18', '15:30:00'),
(2, 1, '2020-02-22', '19:00:00'),
(3, 1, '2020-03-06', '19:00:00'),
(4, 1, '2020-03-21', '11:00:00'),
(5, 2, '2020-01-22', '15:00:00'),
(6, 2, '2020-02-01', '19:00:00'),
(7, 2, '2020-02-13', '18:00:00'),
(8, 3, '2020-01-24', '16:30:00'),
(9, 3, '2020-02-13', '18:30:00'),
(11, 3, '2020-02-17', '16:00:00'),
(10, 3, '2020-02-20', '19:00:00'),
(14, 4, '2020-02-19', '18:00:00'),
(12, 4, '2020-02-27', '15:00:00'),
(13, 4, '2020-03-10', '18:30:00'),
(15, 4, '2020-03-10', '19:00:00'),
(17, 5, '2020-03-14', '15:30:00'),
(16, 5, '2020-03-17', '14:30:00'),
(18, 5, '2020-03-24', '19:00:00'),
(19, 5, '2020-04-04', '17:00:00'),
(20, 6, '2020-03-16', '19:00:00'),
(21, 6, '2020-04-04', '19:00:00'),
(23, 6, '2020-04-08', '17:30:00'),
(22, 6, '2020-04-11', '19:00:00'),
(26, 7, '2020-04-10', '15:30:00'),
(27, 7, '2020-04-11', '19:00:00'),
(24, 7, '2020-04-18', '19:00:00'),
(25, 7, '2020-04-30', '18:00:00'),
(30, 8, '2020-04-13', '15:30:00'),
(28, 8, '2020-04-21', '15:00:00'),
(31, 8, '2020-05-02', '14:30:00'),
(29, 8, '2020-05-02', '16:30:00'),
(33, 9, '2020-05-06', '16:30:00'),
(32, 9, '2020-05-09', '14:30:00'),
(34, 9, '2020-05-16', '15:00:00'),
(35, 9, '2020-05-28', '19:00:00'),
(36, 10, '2020-05-08', '14:00:00'),
(37, 10, '2020-05-28', '18:30:00'),
(39, 10, '2020-06-01', '16:00:00'),
(38, 10, '2020-06-04', '19:00:00'),
(42, 11, '2020-06-03', '15:00:00'),
(40, 11, '2020-06-11', '18:30:00'),
(41, 11, '2020-06-23', '17:30:00'),
(43, 12, '2020-06-23', '14:00:00'),
(45, 12, '2020-06-27', '14:00:00'),
(44, 12, '2020-06-30', '15:00:00'),
(46, 12, '2020-07-07', '14:30:00'),
(48, 13, '2020-06-29', '19:00:00'),
(49, 13, '2020-07-01', '17:00:00'),
(50, 13, '2020-07-11', '14:00:00'),
(47, 13, '2020-10-26', '19:30:00'),
(52, 14, '2020-07-03', '17:00:00'),
(51, 14, '2020-07-23', '15:30:00'),
(53, 14, '2020-07-23', '17:00:00'),
(54, 14, '2020-07-30', '19:30:00'),
(55, 15, '2020-07-27', '18:30:00'),
(58, 15, '2020-07-29', '19:00:00'),
(56, 15, '2020-08-06', '14:00:00'),
(57, 15, '2020-08-18', '16:00:00'),
(59, 16, '2020-08-18', '18:30:00'),
(61, 16, '2020-08-22', '16:00:00'),
(60, 16, '2020-08-25', '14:00:00'),
(62, 16, '2020-09-01', '15:30:00'),
(64, 17, '2020-08-24', '14:00:00'),
(65, 17, '2020-09-12', '18:00:00'),
(66, 17, '2020-09-19', '14:30:00'),
(67, 18, '2020-09-16', '16:30:00'),
(70, 18, '2020-09-18', '16:00:00'),
(68, 18, '2020-09-26', '18:00:00'),
(69, 18, '2020-10-08', '14:00:00'),
(71, 19, '2020-09-19', '19:30:00'),
(74, 19, '2020-09-21', '14:30:00'),
(72, 19, '2020-09-29', '15:00:00'),
(73, 19, '2020-10-10', '17:00:00'),
(75, 20, '2020-10-10', '19:30:00'),
(76, 20, '2020-10-17', '14:00:00'),
(78, 20, '2020-10-24', '16:00:00'),
(80, 21, '2020-10-16', '15:30:00'),
(81, 21, '2020-10-31', '15:30:00'),
(79, 21, '2020-11-05', '19:00:00'),
(82, 21, '2020-11-12', '17:30:00'),
(83, 1, '2020-03-25', '17:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `idProfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `login`, `password`, `idProfil`) VALUES
(1, 'Bernède', 'Béatrice', 'beatrice.bernede@gmail.com', 'admin', '$2y$10$5v3q.npdkpmvyGz3UUefDuW9tcooK/Ql8DyRvXelfUfbvqdr3tPGe', 1),
(2, 'Charles-Henri', 'Delaplace', 'chdelaplace@gmail.com', 'empl', '$2y$10$5v3q.npdkpmvyGz3UUefDuW9tcooK/Ql8DyRvXelfUfbvqdr3tPGe', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_session` (`idAtelier`,`dateSession`,`heureDebut`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD CONSTRAINT `atelier_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`idAtelier`) REFERENCES `atelier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
