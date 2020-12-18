/* Import These Data into your Database*/

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author_name` varchar(55) DEFAULT NULL,
  `isbn` int(15) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `UNIQUE_ISBN` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

/*Data for the table `books` */

insert  into `books`(`book_id`,`title`,`author_name`,`isbn`,`release_date`,`last_update`,`user_id`) values 

(16,'Indian Politics 2021','test 1',1360918141,NULL,'2020-06-25 15:46:21',1),

(22,'Indian Politics','test',78888888,NULL,'2020-06-25 15:32:15',1),

(25,'Indian Politics','test',788888891,NULL,'2020-06-25 15:33:45',1),

(29,'Indian Politics','test',1861972717,NULL,'2020-06-26 08:03:43',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_name`,`email`) values 

(1,'sapan','ctoattraveltech@gmail.com'),

(2,'akram','akram@shoppinpal.com ');


