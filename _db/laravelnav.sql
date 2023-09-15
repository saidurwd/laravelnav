/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - laravelnav
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`name`,`email`,`address`,`created_at`,`updated_at`) values 
(1,'Storagely.io','test@domain.com','Dhaka, Bangladesh','2023-09-10 10:03:55','2023-09-10 10:04:08');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_09_07_165507_create_menu_settings_table',1),
(6,'2023_09_07_170209_create_menus_table',1),
(7,'2023_09_10_093656_create_companies_table',2);

/*Table structure for table `navigation_settings` */

DROP TABLE IF EXISTS `navigation_settings`;

CREATE TABLE `navigation_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('TYPE','LOCATION') NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `navigation_settings` */

insert  into `navigation_settings`(`id`,`type`,`title`,`created_at`,`updated_at`) values 
(1,'LOCATION','Main Navigation','2023-09-09 09:55:28','2023-09-09 09:55:41'),
(2,'LOCATION','Top Header','2023-09-09 09:55:34','2023-09-09 09:55:43'),
(3,'LOCATION','Footer','2023-09-09 09:55:38','2023-09-09 09:55:44'),
(4,'TYPE','Single Menu','2023-09-09 10:01:04','2023-09-09 10:01:09'),
(5,'TYPE','Dropdown Menu','2023-09-09 10:01:07','2023-09-09 10:01:11');

/*Table structure for table `navigations` */

DROP TABLE IF EXISTS `navigations`;

CREATE TABLE `navigations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(4) DEFAULT 0,
  `external_link` enum('Yes','No') DEFAULT 'No',
  `ordering` int(11) DEFAULT 0,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `navigations` */

insert  into `navigations`(`id`,`parent`,`user_id`,`location_id`,`type_id`,`menu_name`,`menu_link`,`new_tab`,`external_link`,`ordering`,`status`,`created_at`,`updated_at`) values 
(2,0,NULL,1,4,'Storage Locations','/storage-locations',0,'No',3,'Active','2023-09-09 07:44:18','2023-09-12 18:44:14'),
(3,0,NULL,1,4,'Resources','/resources',0,'No',2,'Inactive','2023-09-09 07:44:45','2023-09-14 16:35:04'),
(7,2,NULL,1,5,'Sub Menu 1','/submenu1',0,'No',4,'Active','2023-09-09 18:23:11','2023-09-12 18:44:14'),
(9,0,NULL,1,4,'Home','/home',0,'No',1,'Active','2023-09-10 09:16:17','2023-09-12 18:44:51'),
(10,0,NULL,1,4,'Blog','/blog',0,'No',6,'Active','2023-09-10 09:20:38','2023-09-12 18:44:31'),
(11,0,NULL,1,4,'Media','/media',0,'No',8,'Active','2023-09-10 09:21:50','2023-09-12 18:44:14'),
(12,2,NULL,1,4,'Sub Menu 2','/submenu2',0,'No',5,'Active','2023-09-10 09:28:15','2023-09-12 18:44:14'),
(13,10,NULL,1,4,'Sub Menu 3','/submenu3',1,'No',7,'Inactive','2023-09-10 09:29:09','2023-09-12 18:44:31'),
(20,0,NULL,1,4,'TEST','/test',1,'No',9,'Active','2023-09-12 14:41:59','2023-09-12 18:44:14');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
