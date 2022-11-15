/*
SQLyog Community
MySQL - 10.4.24-MariaDB : Database - gvtrack
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `gv` */



CREATE TABLE `gv` (
  `paramcode` varchar(255) DEFAULT NULL,
  `mtd` float DEFAULT NULL,
  `ytd` float DEFAULT NULL,
  `target` float DEFAULT NULL,
  `marsha` varchar(5) DEFAULT NULL,
  CONSTRAINT `gv_ibfk_1` FOREIGN KEY (`paramcode`) REFERENCES `parameters` (`paramcode`),
  CONSTRAINT `gv_ibfk_2` FOREIGN KEY (`marsha`) REFERENCES `property` (`marsha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `gv` */

insert  into `gv`(`paramcode`,`mtd`,`ytd`,`target`,`marsha`) values 
('CL001',77,90,90,'SUBSI'),
('EA001',89,93,90,'SUBSI'),
('FAB001',90,91,90,'SUBSI'),
('ITR001',90,88,90,'SUBSI'),
('MAU001',88,90,90,'SUBSI'),
('SS001',86,81,90,'SUBSI');

/*Table structure for table `parameters` */



CREATE TABLE `parameters` (
  `paramcode` varchar(255) PRIMARY KEY NOT NULL,
  `paramname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `parameters` */

insert  into `parameters`(`paramcode`,`paramname`) values 
('CL001','Cleanliness'),
('EA001','Elite Appreciation'),
('FAB001','Food and Beverage'),
('ITR001','Intent to Recommend'),
('MAU001','Maintenance and Upkeep'),
('SS001','Staff Service');

/*Table structure for table `property` */



CREATE TABLE `property` (
  `marsha` varchar(5) PRIMARY KEY NOT NULL,
  `propertyname` varchar(255) DEFAULT NULL
) 

/*Data for the table `property` */

insert  into `property`(`marsha`,`propertyname`) values 
('SUBFP','Four Points by Sheraton Surabaya'),
('SUBSI','Sheraton Surabaya Hotels & Towers');

/*Table structure for table `users` */



CREATE TABLE `users` (
  `username` varchar(255) PRIMARY KEY NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `property` varchar(255) DEFAULT NULL,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`property`) REFERENCES `property` (`marsha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`username`,`password`,`role`,`property`) values 
('adminsubfp','admin','ADMIN','SUBFP'),
('adminsubsi','admin','ADMIN','SUBSI'),
('subfp','subfp','CHAMP','SUBFP'),
('subsi','subsi','CHAMP','SUBSI');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
