-- MariaDB dump 10.19  Distrib 10.6.4-MariaDB, for osx10.16 (x86_64)
--
-- Host: 0.0.0.0    Database: docroot
-- ------------------------------------------------------
-- Server version	10.6.5-MariaDB-1:10.6.5+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220123183528','2022-01-24 20:15:01',104),('DoctrineMigrations\\Version20220123191121','2022-01-24 20:15:01',8),('DoctrineMigrations\\Version20220124212117','2022-01-24 21:28:34',20);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'post','Stack Technique','<div>Avant de publier de beaux articles dans ce blog, il a fallu le concevoir...</div>','<div>PHP 7.4 Symfony 5.4, mariadb 10.6.5 dans un docker.&nbsp;<br><br></div><pre>composer install</pre><div><br><br><br><br><br><br><br><br></div>','stack-technique','2022-01-24 20:46:52','2022-01-24 22:00:09'),(2,'post','installation de ce blog','<div>note au fil de l\'eau sur la construction de ce blog.</div>','<pre>INSTALLATION:\r\n\r\nsymfony new documentroot --version=next\r\n\r\ncd documentroot/\r\n\r\n//installation du certification SSL\r\nbrew install nss (automatisation certificat pour firefox)\r\nsymfony server:ca:install (certificat)\r\n\r\n//Run webserver\r\nsymfony serve -d # lancement server\r\nsymfony server:stop # Arret server\r\nsymfony server:logs # Stream des logs symfony\r\n\r\nInstallation des bundles inévitables:\r\n\r\n* composer require symfony/maker-bundle --dev\r\n    * (symfony composer req maker --dev )\r\n* composer require symfony/profiler-pack --dev\r\n    * (symfony composer req profiler --dev)\r\n* composer require symfony/debug --dev\r\n    * (symfony composer req debug --dev)\r\n* composer require symfony/monolog-bundle -W\r\n    * (symfony composer req logger -W) # -W with-all-dependencies\r\n* composer require sensio/framework-extra-bundle\r\n    * (symfony composer req annotations)\r\n* composer require symfony/orm-pack:^2\r\n    * (symfony composer req \"orm:^2\" )\r\n* composer require symfony/validator\r\n    * (symfony composer req validator)\r\n* composer require symfony/twig-pack\r\n    * (symfony composer req twig)\r\n* composer require twig/intl-extra:^3\r\n    * (symfony composer req \"twig/intl-extra:^3\")\r\n* composer require twig/extra-bundle\r\n    * (symfony composer req \"twig/extra-bundle\")\r\n* composer require phpunit/phpunit --dev\r\n    * (symfony composer req phpunit --dev)\r\n* composer require doctrine/doctrine-fixtures-bundle --dev\r\n    * (symfony composer req orm-fixtures --dev)\r\n\r\n<em>## Installation Postgres sql via docker:\r\n\r\n</em>on complète le fichier docker-compose.yaml:\r\n\r\n```\r\nversion: \'3\'\r\n\r\nservices:\r\n  database:\r\n    image: postgres:13-alpine\r\n    environment:\r\n      POSTGRES_USER: document\r\n      POSTGRES_PASSWORD: root\r\n      POSTGRES_DB: documentroot\r\n    ports: [5432]\r\n```\r\n\r\nPuis on lance le container:\r\n```\r\ndocker-compose up -d\r\n```\r\nPour récupérer le port de connection:\r\n```\r\ndocker ps\r\n```\r\nPour se connecter à Postgres dans le container:\r\n\r\n```\r\ndocker exec -it f71d5165055f psql -d documentroot -U document\r\n```\r\n\r\nrappel postgres :\r\n* \\? : liste des commandes\r\n* \\l : show databases\r\n* \\c documentroot : changer de bdd\r\n* \\dt : show tables\r\n* \\d &lt;table_name&gt; : show table details\r\n\r\nAujourd\'hui, il faut relancer la migration pour remplir la bdd.\r\n\r\nGeneration et execution de la migration pour la bdd.\r\n```\r\nsymfony console make:migration\r\nsymfony console doctrine:migrations:migrate\r\n```\r\n\r\nmettre à jour le port dans le .env:\r\n```\r\nDATABASE_URL=\"postgresql://document:root@0.0.0.0:53419/docroot?serverVersion=13&amp;charset=utf8\"\r\n```\r\n\r\n\r\n<em>## Initialisation du front :\r\n\r\n</em>Techno :\r\ntwig, webpack encore(equivalent de npm, yarn), vuejs, bootstrap, scss\r\n\r\n\r\n\r\n```\r\ncomposer require symfony/webpack-encore-bundle\r\n* symfony composer req encore\r\n\r\nyarn add node-sass sass-loader --dev\r\nyarn add bootstrap@4 jquery popper.js bs-custom-file-input --dev\r\nyarn add vue --dev\r\n\r\n\r\nencore dev\r\n\r\nsymfony run yarn encore dev\r\nsymfony run yarn encore dev --watch\r\n```\r\n\r\nOn génère les 2 premieres entités, contenant la relation ManyToMany:\r\n```\r\nsymfony console make:entity Post\r\nsymfony console make:entity Tag\r\n```\r\n\r\nGeneration et execution de la migration pour la bdd.\r\n```\r\nsymfony console make:migration\r\nsymfony console doctrine:migrations:migrate\r\n```\r\n\r\nInstallation d\'une interface admin\r\n```\r\nsymfony composer req \"admin:^3\"\r\nmkdir src/Controller/Admin/\r\nsymfony console make:admin:dashboard\r\nsymfony console make:admin:crud\r\n```\r\n\r\n```\r\ncomposer require twig/markdown-extra\r\n```\r\n\r\nAPI PLATFORM : \r\n```\r\ncomposer require api\r\n```\r\n\r\nMigration de la bdd sous docker (postgres) en local (mysql)\r\nmaj du .env DATABASE_URL\r\nsuppression des fichiers de migrations existants\r\n```\r\nbin/console doctrine:database:create\r\nsymfony console make:migration\r\nbin/console doctrine:migrations:migrate\r\n```\r\n\r\nDoctrine Extension : \r\n```\r\ncomposer require stof/doctrine-extensions-bundle\r\n```\r\nnon utilisé:\r\nhttps://github.com/doctrine-extensions/DoctrineExtensions\r\ncomposer require gedmo/doctrine-extensions\r\n\r\n\r\nhttps://blog.digivia.fr/article/un-bon-bundle-pour-vos-fixtures-en-yaml\r\n<br></pre><div><br></div>','note-blog','2022-01-24 22:17:56','2022-01-24 22:17:56'),(3,'post','Amazon Web Service AWS','<div>Note sur AWS</div>','<pre>DOCS : \r\n\r\nTuto abordant les principaux services AWS, assez bien fait pour démarrer\r\nhttps://openclassrooms.com/fr/courses/4810836-decouvrez-le-cloud-avec-amazon-web-services\r\n\r\n\r\n\r\n\r\nJ\'ai souscrit à un abonnement gratuit à AWS pendant 1an pour tester les services offerts par Amazon WS (serveur, stockage, bdd...).\r\nCette offre inclus une instance t2.micro qui vas etre utilisé comme un serveur de préprod.\r\n\r\n\r\nloic.cotty@gmail.com / 4B9Q9:3eX3Cr@kt\r\n\r\n\r\ncredentials : \r\n\r\nID de clé d\'accès :\r\nAKIAIAJKH3ESYJOUUKIA\r\nClé d\'accès secrète :\r\ndMDZfxD8OAjMUcCJQGgZ1/ngSzzGtL4veSZBL1GA\r\n\r\n\r\nInformations concernant EC2:\r\n\r\nINSTANCE ID : i-0c816809a1af66d31\r\nType d\'instance : t2.micro\r\nIP Publique : 35.180.72.59\r\nZone : eu-west-3c\r\nSystème : LAMP 7.3 (image Bitnami LAMP)\r\n\r\n\r\nurl d\'administration : \r\nhttps://eu-west-3.console.aws.amazon.com/ec2/v2/home?region=eu-west-3#Instances:\r\n\r\nUne Ip publique fixe a été attribuée, a cette instance (menu : Réseau et sécurité -&gt; Adresses IP Elastic )\r\n\r\n\r\nPour se connecter au serveur en ssh, depuis le terminal : \r\nssh -i \"~/.ssh/aws.pem\" ubuntu@ec2-35-180-72-59.eu-west-3.compute.amazonaws.com\r\n\r\n\r\nLe serveur WEB dans /opt/bitnami/apache2/htdocs/ ou dans /home/bitnami/htdocs\r\nla home est ici : /home/bitnami\r\n\r\nIl y a une instance mysql sur le serveur EC2, mais nous utilisons plutot un rds dédié.\r\n\r\nBitnami Mysql\r\nuser : root\r\npassword : EB7S61NSVTRp \r\n\r\n\r\nBitnami account: \r\nloic.cotty@gmail.com / 8xXFvDcLY$TVE5@\r\n\r\n\r\nRDS : \r\naws-databases:\r\nhost : aws-databases.cvbtyj4xfjz3.eu-west-3.rds.amazonaws.com\r\nidentifiant : aws_db\r\npassword : Amaz0n3!\r\n\r\nVisibilité publique, on peux y acceder avec mysqlworkbench, et depuis le serveur ECS.\r\nEnvisager des tests, afin de n\'autoriser que mon IP privée...\r\n\r\nDepuis EC2 :\r\nmysql -h aws-databases.cvbtyj4xfjz3.eu-west-3.rds.amazonaws.com -P 3306 -u aws_db -p\r\n\r\n\r\n\r\nLa connection fonctionne entre EC2 et RDS.\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br></pre><div><br></div><div><br></div>','aws','2022-01-24 22:22:28','2022-01-24 22:24:43'),(4,'post','Yarn','<div>yarn</div>','<div>yarn:<br><br>comble les lacunes de npm... mais a besoin de npm pour fonctionner !<br><br>https://blog.zenika.com/2017/03/13/npm-vs-yarn/<br><br><br>https://symfony.com/doc/current/frontend/encore/simple-example.html<br><br><br>//ajouter une lib<br>yarn add bootstrap-sass jquery sass-loader node-sass webpack-notifier --env<br><br><br>to deploy assets<br>yarn run encore dev<br><br><br><br>https://knpuniversity.com/screencast/webpack-encore/copy-plugin<br>yarn add copy-webpack-plugin --dev<br><br>Encore<br>... lines 5 - 18<br>&nbsp; &nbsp; .addPlugin(new CopyWebpackPlugin([<br>&nbsp; &nbsp; &nbsp; &nbsp; // copies to {output}/images<br>&nbsp; &nbsp; &nbsp; &nbsp; { from: \'./assets/images\', to: \'images\' }<br>&nbsp; &nbsp; ]))<br>;</div>','yarn','2022-01-24 22:25:35','2022-01-24 22:25:35'),(5,'post','Git','<div>principales commandes git&nbsp;</div>','<div>https://help.github.com/articles/adding-an-existing-project-to-github-using-the-command-line/<br><br>initialize project:<br><br>git init (create or replace if exist) a new .git folder<br><br><br>pour définir le project sur le repo git:<br>git remote add origin [remote repository URL]&nbsp;<br>git remote add origin git@github.com:loic-cotty/lefaineant-blog-api.git<br><br><br>echo \"# blog-api\" &gt;&gt; README.md<br>git init<br>git add README.md<br>git commit -m \"first commit\"<br>git branch -M main<br>git remote add origin git@github.com:loic-cotty/blog-api.git<br>git push -u origin main<br><br><br>git remote -v //to remind the repo url<br><br>ALIAS:<br>see: https://git-scm.com/book/fr/v2/Les-bases-de-Git-Les-alias-Git<br>$ git config --global alias.co checkout<br>$ git config --global alias.br branch<br>$ git config --global alias.ci commit<br>$ git config --global alias.st status<br><br><br>Delete a local branch : git branch -D&nbsp;<br><br><br></div>','git','2022-01-24 22:28:11','2022-01-24 22:28:37');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  KEY `IDX_5ACE3AF0BAD26311` (`tag_id`),
  CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` VALUES (1,1),(1,2),(3,3),(5,12);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'PHP','2022-01-24 21:28:40','2022-01-24 21:28:40'),(2,'Symfony','2022-01-24 21:28:46','2022-01-24 21:28:46'),(3,'AWS','2022-01-24 22:22:38','2022-01-24 22:22:38'),(4,'composer','2022-01-24 22:22:53','2022-01-24 22:22:53'),(5,'docker','2022-01-24 22:23:02','2022-01-24 22:23:02'),(6,'laravel','2022-01-24 22:23:09','2022-01-24 22:23:09'),(7,'postman','2022-01-24 22:23:22','2022-01-24 22:23:22'),(8,'prestashop','2022-01-24 22:23:34','2022-01-24 22:23:34'),(9,'SQL','2022-01-24 22:23:43','2022-01-24 22:24:25'),(10,'Symfony5','2022-01-24 22:23:50','2022-01-24 22:23:50'),(11,'javascript','2022-01-24 22:24:05','2022-01-24 22:24:05'),(12,'git','2022-01-24 22:28:17','2022-01-24 22:28:17'),(13,'yarn','2022-01-24 22:28:23','2022-01-24 22:28:23');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'docroot'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-24 23:31:59
