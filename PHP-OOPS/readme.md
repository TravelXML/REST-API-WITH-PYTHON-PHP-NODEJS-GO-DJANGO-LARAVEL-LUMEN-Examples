# Rest API with CURD, PHP PDO, UNIT Testing, JWT, EXAMPLES

## What's REST API or RESTFUL API?

REST is acronym for REpresentational State Transfer. RESTful API is an architectural style for an application program interface (API) that uses HTTP requests to access and alter data. That data can be used to GET, PUT, POST and DELETE data types, which refers to the reading, updating, creating and deleting of operations concerning resources. [For More Details](https://en.wikipedia.org/wiki/Representational_state_transfer)

## What's JWT?

JWT stand for JSON Web Tokens, are an open, industry standard RFC 7519 method for representing claims securely between two parties. For details [Click Here](https://en.wikipedia.org/wiki/JSON_Web_Token)

If you want to play around with JWT token the here is your [play ground](https://jwt.io/)

### HOW JWT token look like

![JWT token with PHP REST API](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-1.png)

# We will be creating a very simple REST API using

    - PHP Programming Language with Object Oriented Concept
    - PDO Library
    - Mysql Database
    - JWT Auth
    - Unit Tetsing
    

### Create a RESTful web service for a Library. The service must have the following API endpoints:

    - (C)reate a new Book
    - (R)ead existing Books
    - (U)pdate an existing Book
    - (D)elete an existing Book
    
### All test will perform using POSTMAN

## Prerequisites 

    - PHP Installation
    - Mysql Installation
    - Composer Installation
    - Local Apache Server UP
    
Rather than any individual installations you can use package installer which is really handy, [XAMPP](https://www.apachefriends.org/index.html) and [WAMP](https://www.wampserver.com/en/) for windows, Lamp for linux.
    
You should have knowledge of PHP OOPS, to get started with the project that we are going to do.

Don't be disappointed 💔 if you don't know PHP, If you know any programming language that should be fine as well, COOL?

**Let’s Go!**

## How to Start?

- Create Project folder 'bookstore'
- Download Script from Github Repository to your project folder
- Go To Project Folder

    ```
    cd bookstore
    ```

- RUN Below Command

    ```
    Composer update
    ```
- UP the Mysql Server and create Database 'rest-api' 
- Run all queries
    
 ```
     //config/DatabaseImport.sql
     
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
              `password` varchar(50) DEFAULT NULL,
              PRIMARY KEY (`user_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

            /*Data for the table `users` */

            insert  into `users`(`user_id`,`user_name`,`email`,`password`) values 

            (1,'sapan','ctoattraveltech@gmail.com','c1bdcee164660e8bcf4eabbc2ad9d470'),

            (2,'akram','akram@shoppinpal.com','c1bdcee164660e8bcf4eabbc2ad9d470');

```

#### Now Your API endpoint is Ready For Test, If you want to understand about the implementation then go through the below section otherwise you can skip the below one. 

## Files and Folders

![PHP REST API Files and Folders](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-2.png)
  - **config**  
    - Database.php - file about database connectivity
    - DatabaseImport.sql - sql import data - migration
  - **test**
    - `CreateBook.php` - test create book functionality
    - `ReadBook.php` - test read book functionality
    - `DeleteBook.php` - test delte book functionality
    - `UpdateBokk.php` - test update book functionality
    - `ReadBookSingle.php` - read book by id functionality
  - **book.class.php** - controller, router
  - **index.php** - ping point
  - **readme.txt** - instructions
  
#### Basic testing done for all functions like create, update, read & delete book

This can be extend with more functionalities like input and output validation & parameters matching and sign-in proccess as well. 

All this test conducted using HTTP_Request2 PEAR library.

For more details you visit: https://pear.php.net/manual/en/package.http.http-request2.config.php

### Ready to test, let's goahead with testing using POSTMAN

All Requests and responses are JSON data

### What all Endpoints are available for test?

    - Sign-in for auth token - `'sign_in'`
    - (C)reate a new Book - `'create_book'`
    - (R)ead existing Books - `'read_book'`
    - (U)pdate an existing Book - `'update_book'`
    - (D)elete an existing Book - `'delete_book'`
    
### Open Your POSTMAN

 - Create a Collection - `PHP REST API`
 - Single endpoint for all operation - `http://localhost/bookstore/`
 - Method Always `POST`
 - Auth Required for all requests apart of sign-in
 
### Lets test?

- Signin - fetch Auth Token for all requests, it need to send via header

![PHP REST API Pass JWT token Via Request Header](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-3.png)

- Get Token Id on Sucessful Sign-in
![PHP REST API get JWT token for sign in](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-4.png)

- Create Book
![PHP REST API - Create Book](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-5.png)

- Read Book
![PHP REST API - Read Book](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-6.png)

- Read Book By Id
![PHP REST API - Read Book By Id](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-7.png)

- Update Book
![PHP REST API - Update Book](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-8.png)

- Delete Book
![PHP REST API - Delete Book](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-10.png)
 





### For Support, you can reach me 
-------------------------------
#### Skype: sapan.mohannty
#### Twitter: https://twitter.com/htngapi
#### Linkedin: https://www.linkedin.com/in/travel-technology-cto/

