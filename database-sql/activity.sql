/*
SQLyog Professional v12.09 (64 bit)
MySQL - 8.0.17 : Database - activity
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`activity` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `activity`;

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `order_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `domain_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `client` */

insert  into `client`(`id_client`,`client_name`,`status`,`duration`,`order_type`,`domain_name`) values (1,'Irfan','1','1 Tahun','Website','butik-kitchen.com'),(2,'Ahdi','1','1 Tahun','Website','firstmedia-tv.com');

/*Table structure for table `identitas` */

DROP TABLE IF EXISTS `identitas`;

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_website` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_deskripsi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `meta_keyword` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `favicon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_identitas`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `identitas` */

insert  into `identitas`(`id_identitas`,`nama_website`,`alamat_website`,`meta_deskripsi`,`meta_keyword`,`favicon`) values (1,'bukulokomedia.com - penerbit lokomedia yogyakartas','http://localhost/lokomedia','lokomedia adalah penerbit buku-buku komputer khususnya di bidang pemrograman web dan internet.','lokomedia, bukulokomedia, toko online, buku komputer, trik, tutorial, konsultasi, distro kaos, php','favicon.ico');

/*Table structure for table `package` */

DROP TABLE IF EXISTS `package`;

CREATE TABLE `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` int(100) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `package` */

insert  into `package`(`id`,`package_name`,`id_tagihan`) values (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,1,2),(6,2,2),(7,3,2),(8,1,3),(9,2,3),(10,1,4),(11,2,4);

/*Table structure for table `persons` */

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `persons` */

insert  into `persons`(`id`,`firstName`,`lastName`,`gender`,`address`,`dob`) values (1,'Airi','Satou','female','Tokyo','1964-03-04'),(2,'Garrett','Winters','male','Tokyo','1988-09-02'),(3,'John','Doe','male','Kansas','1972-11-02'),(4,'Tatyana','Fitzpatrick','male','London','1989-01-01'),(5,'Quinn','Flynn','male','Edinburgh','1977-03-24'),(6,'rizal','valry','male','cikoko','2020-11-22');

/*Table structure for table `persons_brand` */

DROP TABLE IF EXISTS `persons_brand`;

CREATE TABLE `persons_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `persons_brand` */

insert  into `persons_brand`(`id`,`firstName`,`lastName`,`gender`,`address`,`dob`,`photo`) values (2,'Garrett','Winters','male','Tokyo','1988-09-02',NULL),(3,'John','Doe','male','Kansas','1972-11-02',NULL),(4,'Tatyana','Fitzpatrick','male','London','1989-01-01',NULL),(6,'anum','bramantio','female','cikoko','2022-06-27',''),(8,'Rafan','Abyansyah','male','Cikoko','2018-10-06',''),(9,'vanus','client','male','kalibata','1991-02-13','1673268366710.jpg');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `imgpath` varchar(100) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `product` */

insert  into `product`(`id`,`slug`,`title`,`description`,`price`,`imgpath`,`is_available`) values (108,'Application','Sistem','Valry Apps',2000000,NULL,1),(110,'isi baru','coba deh','idnya bebas',1200,NULL,1),(112,'Aqua','Danone','Air',12500,NULL,1);

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name_profile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address_profile` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hp_profile` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_profile` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_profile`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `profile` */

insert  into `profile`(`id_profile`,`name_profile`,`address_profile`,`hp_profile`,`email_profile`) values (1,'Muhamad Rizal','Cikoko Barat Dalam III','085781571742','rizal.muh.rzl@gmail.com');

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `jatuh_tempo` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sisa_pengerjaan` int(50) DEFAULT NULL,
  `tenor` int(15) DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `project` */

insert  into `project`(`id`,`nama_project`,`tanggal_mulai`,`jatuh_tempo`,`sisa_pengerjaan`,`tenor`,`status`) values (5,'reload test','2024-01-01','2023-12-11',5,10,'finished'),(6,'Altrovis','2023-01-19','2023-01-30',5,8,'Unfinished');

/*Table structure for table `project_detail` */

DROP TABLE IF EXISTS `project_detail`;

CREATE TABLE `project_detail` (
  `id_detail` int(255) NOT NULL AUTO_INCREMENT,
  `nama_project` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cicilan_ke` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `jumlah_project` int(80) DEFAULT NULL,
  `id_project` int(11) DEFAULT NULL,
  `status_bayar` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `note` text,
  `assign` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_detail`) USING BTREE,
  KEY `id_tagihan` (`id_project`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `project_detail` */

insert  into `project_detail`(`id_detail`,`nama_project`,`cicilan_ke`,`tanggal_bayar`,`jumlah_project`,`id_project`,`status_bayar`,`note`,`assign`) values (27,'kopi kenangan','1','2023-01-12 13:03:35',10,5,'finished','hari ini oke','12'),(28,'kopi kenangan','2','2023-01-12 13:14:44',10,5,'finished','Status OKe','12'),(29,'kopi kenangan','3','2023-01-12 13:16:34',10,5,'finished','dicoba lagi','12'),(30,'kopi kenangan','4','2023-01-12 13:26:49',10,5,'finished','ke empat beres','12'),(31,'kopi kenangan','5','0000-00-00 00:00:00',10,5,'Unfinished','semoga bisa',NULL),(32,'kopi kenangan','6','0000-00-00 00:00:00',10,5,'Unfinished','apapun kesulitan itu, akan menjadi kemudahan',NULL),(33,'kopi kenangan','7','0000-00-00 00:00:00',10,5,'Unfinished','sebentar lagi perubahan',NULL),(34,'kopi kenangan','8','0000-00-00 00:00:00',10,5,'Unfinished','majulah terus',NULL),(35,'kopi kenangan','9','0000-00-00 00:00:00',10,5,'Unfinished','lihatlah kepada sujudmu',NULL),(36,'kopi kenangan','10','0000-00-00 00:00:00',10,5,'Unfinished','ini terakhir','12'),(37,'Altrovis','1',NULL,2,6,'Unfinished',NULL,NULL),(38,'Altrovis','2',NULL,2,6,'Unfinished',NULL,NULL),(39,'Altrovis','3',NULL,2,6,'Unfinished',NULL,NULL),(40,'Altrovis','4',NULL,2,6,'Unfinished',NULL,NULL),(41,'Altrovis','5',NULL,2,6,'Unfinished',NULL,NULL),(42,'Altrovis','6',NULL,2,6,'Unfinished',NULL,NULL),(43,'Altrovis','7',NULL,2,6,'Unfinished',NULL,NULL),(44,'Altrovis','8',NULL,2,6,'Unfinished',NULL,NULL);

/*Table structure for table `tempo` */

DROP TABLE IF EXISTS `tempo`;

CREATE TABLE `tempo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempo` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `tempo` */

insert  into `tempo`(`id`,`tempo`) values (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`email`,`image`,`password`,`role_id`,`is_active`,`date_created`) values (12,'rizal valry','rizal.muh.rzl@gmail.com','thm_luffy.jpg','$2y$10$/9bbT0GrimbkV3k8g/g0ZuSotAPbbTacXEHqn5xzFE642PCrHSf1i',1,1,1604206363),(16,'user','cawangbsi@gmail.com','default.jpg','$2y$10$gb2iiRn1pjAhnUBzfB3uD.DeUO3oHOvJzWwHpz7mtB82eybEyFgTu',2,1,1604208840),(17,'shanum','shanum@gmail.com','default.jpg','$2y$10$pUyoBtDNoT/8gDuMaCUf3uPJAO9ayK2lLPY2kJP/DdD1Lq4619KvK',2,0,1673267125);

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,1,1),(3,2,2),(7,1,3),(8,1,2),(9,1,4),(18,2,4);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`) values (1,'Admin'),(2,'User'),(3,'Menu'),(4,'Activity'),(5,'garasi');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Administrator'),(2,'Member');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values (1,1,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),(2,2,'My Profile','user','fas fa-fw fa-user',1),(3,2,'Edit Profile','user/edit','fas fa-fw fa-user-edit',1),(4,3,'Menu Management','menu','fas fa-fw fa-folder',1),(5,3,'Submenu Management','menu/submenu','fas fa-fw fa-folder-open',1),(7,1,'Role','admin/role','fas fa-fw fa-user-tie',1),(8,2,'Change Password','user/changepassword','fas fa-fw fa-key',1),(9,1,'Product','product','fas fa-fw fa-grip-vertical',0),(11,4,'Project','project','fas fa-fw fa-money-bill',1),(13,1,'Person Brand','personbrand','fas fa-address-book',1);

/*Table structure for table `user_token` */

DROP TABLE IF EXISTS `user_token`;

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `user_token` */

insert  into `user_token`(`id`,`email`,`token`,`date_created`) values (1,'cawangbsi@gmail.com','taufSHWsY99f87+qRTxmpBmPoduV6paoLN1bgF7rG4o=',1623302010),(2,'cawangbsi@gmail.com','kVmYW4G86i8aUEQn5stZKAe5GB0d+52FbOWH4L8aCHk=',1673267062),(3,'shanum@gmail.com','KofzYrx9Rzo33t3zv0q0OQIzrG7bCPK6ijLR2EvvEXY=',1673267125);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
