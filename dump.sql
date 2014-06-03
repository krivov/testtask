/*
SQLyog Ultimate v10.42 
MySQL - 5.5.23 : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `colors` */

DROP TABLE IF EXISTS `colors`;

CREATE TABLE `colors` (
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `colors` */

insert  into `colors`(`color`) values ('Blue'),('Green'),('Indigo'),('Orange'),('Red'),('Violent'),('Yellow');

/*Table structure for table `votes` */

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `city` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `votes` float DEFAULT NULL,
  PRIMARY KEY (`city`,`color`),
  KEY `color_frn1` (`color`),
  CONSTRAINT `color_frn1` FOREIGN KEY (`color`) REFERENCES `colors` (`color`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `votes` */

insert  into `votes`(`city`,`color`,`votes`) values ('Anchorage','Green',10),('Anchorage','Yellow',15),('Brooklyn','Blue',250),('Brooklyn','Red',100),('Detroit','Red',160),('Selma','Violent',5),('Selma','Yellow',15);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
