# Nodejs API Tutorial: Express, MYSQL - NodeJS REST API Examples
![Node JS REST API Using Express](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJS-Express-Mysql-REST-API.jpg)

## Why node.js for API development?

Node.js renders such wonderful support to developers for the development of API. A real-time API which is dynamic can be built using node.js. Creating a two-way channel for IT solutions, node.js creates circulation in a data-friendly manner. Experts believe node.js is capable of working in multiple environments and that is the major contributor to its acceptance as a framework that supports the development of an effective and efficient API.

**Let us understand the advantages of node.js to build:**
- **Speed:** A key factor when using node.js is the speed that it renders to the API. Using a single thread, node.js all the related tasks are quickly performed. Going beyond speed it allows building an API that is scalable and secure too. The increased throughput of APIs built using node.js even makes the applications function at 20 times faster so that the engagement between the app and other software solutions is enhanced.

- **Standardized Development:** An API may function even at unprecedented infrastructures so before you build an API, you must know the standard processes across industries. With node.js, a developer does not need to worry about development process standards that will make an API functional across multiple interfaces. API frameworks are generally developed to standardize development processes according to the target industry or requirements. Using node.js will payback as your API and apps will gain traction for its integrational capabilities to conventional and standard tools.

- **Versioning is Easy:** An API is just like any program that will need versioning as it advances through the development cycle after testing. With node.js versioning and documentation is very easy. It allows changing of published APIs very easily so that your users always stay updated about what is new for them in the API. All this API version information can be stored in a URL which makes it easy for the developer to push warnings and updates to the end-user.

- **Pagination and Filtering Feature:** APIs that can deliver entire database content in a call is not liked by users and app owners as they consume lots of resources. A smart API will be the one that puts a limit on the items it displays and node.js allows this to happen. It controls the resource wastage and the performance of the app is upgraded.

- **Ease of Development:** A developer may build lots of APIs based on the user application where it is expected to function with the infrastructure. With the uniformity, readability, and consistency it renders to the code, node.js allows developers to write APIs real quick. It makes transportation the data between the App and the user interface flow in an orchestrated manner. A user may require you to make changes that are related to the infrastructure at his end. With node.js as the documentation, versioning and changing the code becomes easy. Node.js suffices all the needs of the development of APIs in a scalable manner.

- **Security Perspective:** APIs become very important from a security standpoint for both the IT solutions it connects. As API is the top layer, any breach in security standards here becomes catastrophic. Node.js best security practices make it easy for developers to catch any kind of security vulnerability. Its ORM/ODM validates every kind of access to the API database.

Security must never be neglected. Adding features, like authentication controls, access controls, rate limits and more to create security endpoints that curtail any kind of unauthorized users to gain access to the database, is important.

## What's Express?

**[Express](https://expressjs.com/)** is one of the most popular web frameworks for [Node.js](https://nodejs.org/en/) that supports routing, middleware, view system… This tutorial will guide you through the steps of building **NodeJs Restful CRUD API** using [Express](https://expressjs.com/) and interacting with MySQL database.

## How to Build NodeJS API?

To demonstrate how to build a NodeJS API with Express and Mysql, we'll build an API that will be used to create a list of properties. This application will list the following about each Property:

- Property Name
- Address
- City
- Country
- Property Type
- Minimum Price
- Maximum Price
- Ready to Sell or not?

To Build this REST API, we will install Nodejs and Express, this will allow users to have access to some of the endpoints. Don't be disappointed if you don't know NodeJS, If you know any programming language that should be fine as well, COOL?

## Prerequisites
- Knowledge of NodeJS and Express
- Install NodeJS and Express
- Ensure Mysql Server is Up
- Create Mysql Required Tables
- [Postman](https://www.postman.com/) or Similar Type of Application ( [REST Client](https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo), [HTTPie](https://httpie.io/) ..) will be needed to test our endpoints


## Let's Start With NodeJS API?

We will build REST APIs for **creating, retrieving, updating & deleting  for Property Service**.

#### Overview of Node JS API Implementation?

- Start With an Express Web Server.
- We Add Configuration for MySQL Database
- Create Property Model
- Write the Controller
- Then We Define Routes for Handling all CRUD operations
- Finally, we’re Gonna to test the Rest APIs using Postman

## NodeJS API Routes

**POST /properties** - Create New Property

**GET /properties**    - Get All Properties

**GET /properties/27** - Get Single Property with id=27

**PUT /properties/27** - Update Single Property With id=27

**DELETE /properties/27** - Remove Single Property with id=27

**DELETE /properties** - Remove All Properties



## Create NodeJS REST API

Open terminal/console, then create a folder for our application:

    $ mkdir NODEJS
    $ cd NODEJS

#### Initialize the Node.js application with a package.json file:

    npm init

    name: (NODEJS)
    version: (1.0.0)
    description: Node.js Restful CRUD API with Node.js, Express and MySQL
    entry point: (index.js) server.js
    test command:
    git repository:
    keywords: nodejs, express, mysql, restapi
    author: Sapan Mohanty
    license: (ISC)

Is this ok? (yes) yes

Next, we need to install necessary modules: **express, mysql and body-parser**.

Run the command:


    npm install express mysql body-parser --save

The package.json file should look like this:

    {
      "name": "NODEJS",
      "version": "1.0.0",
      "description": "Node.js Restful CRUD API with Node.js, Express and MySQL",
      "main": "server.js",
      "scripts": {
        "test": "echo \"Error: no test specified\" && exit 1"
      },
      "keywords": [
        "nodejs",
        "express",
        "mysql",
        "restapi"
      ],
      "author": "Sapan Mohanty",
      "license": "ISC",
      "dependencies": {
        "body-parser": "^1.19.0",
        "express": "^4.17.1",
        "mysql": "^2.18.1"
      }
    }
    
## Our Folder Structure Will be
![Node JS REST API File and Folder Structure](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/Nodejs-file-folder.png)

## Setup Express Web Server

Now, in the root folder, we create a new file named `server.js`:

    //server.js
    const express = require("express");
    const bodyParser = require("body-parser");

    const app = express();

    // parse requests of content-type - application/json
    app.use(bodyParser.json());

    // parse requests of content-type - application/x-www-form-urlencoded
    app.use(bodyParser.urlencoded({ extended: true }));

    // simple route
    app.get("/", (req, res) => {
      res.json({ message: "Welcome to Nodejs Simple REST API application." });
    });

    require("./app/routes/property.routes.js")(app);

    // set port, listen for requests
    const PORT = process.env.PORT || 3000;
    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}.`);
    });
    
## What are we doing here?

– Import express and body-parser modules. Express is for building the Rest apis, and body-parser helps to parse the request and create the req.body object that we will need to access in our routes.

– Create an Express app, then add body-parser middlewares using `app.use()` method.

– Define a GET route which is simple for testing.

– Listen on port 3000 for incoming requests.

Now we can run the app with command:
    
    node server.js.
    
You will be seeing below screen:

![Node JS REST API Server is UP](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/nodejs-server-up.png)

Open your browser, enter the url [http://localhost:3000/](http://localhost:3000/), you will see:

![Node JS REST API Server](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/Nodejs-server-up-browser.png)

## Create MySQL Table

Before connecting Node.js Application with MySQL, we need to create a properties table in our local environment first.
So run the SQL script below to create properties table:

    USE `nodejs`;

    /*Table structure for table `properties` */

    DROP TABLE IF EXISTS `properties`;

    CREATE TABLE `properties` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `property_name` varchar(150) DEFAULT NULL,
      `address` varchar(220) DEFAULT NULL,
      `city` varchar(50) DEFAULT NULL,
      `country` varchar(50) DEFAULT NULL,
      `type` varchar(50) DEFAULT NULL,
      `minimum_price` decimal(10,2) DEFAULT NULL,
      `maximum_price` decimal(10,2) DEFAULT NULL,
      `ready_to_sell` tinyint(1) DEFAULT 1,
      `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;


## Configure & Connect to MySQL Database

We’re gonna have a separate folder for configuration. Let’s create config folder in the app folder, under application root folder, then create `db.config.js` file inside that config folder with content like this:

    module.exports = {
      HOST: "localhost",
      USER: "root",
      PASSWORD: "",
      DB: "nodejs"
    };


Now create a database connection that uses configuration above.

The file for connection is `db.js`, we put it in the `app/models` folder that will contain the model in the next step.

    // models/db.js

    const mysql = require("mysql");
    const dbConfig = require("../config/db.config.js");

    // Create a connection to the database
    const connection = mysql.createConnection({
      host: dbConfig.HOST,
      user: dbConfig.USER,
      password: dbConfig.PASSWORD,
      database: dbConfig.DB
    });

    // open the MySQL connection
    connection.connect(error => {
      if (error) throw error;
      console.log("Successfully connected to the database.");
    });

    module.exports = connection;
    
## Create the Model

In the models folder, create a file called `property.model.js`. We’re gonna define constructor for Property object here, and use the database connection above to write CRUD functions:

    (C)reate a New Property
    (U)pdate a Property By id
    (R)ead a Property By id
    (R)ead All Properties    
    (D)elete a Property By Id
    (D)elete all Properties

This is the content inside `property.model.js`:

    // models/property.model.js

    const sql = require("./db.js");

    // constructor
    const Property = function(property) {
      this.property_name = property.property_name,
      this.address = property.address,
      this.city = property.city,
      this.country = property.country,
      this.type = property.type,
      this.minimum_price = property.minimum_price,
      this.maximum_price = property.maximum_price,
      this.ready_to_sell = property.ready_to_sell
    };

    Property.create = (newProperty, result) => {
      sql.query("INSERT INTO properties SET ?", newProperty, (err, res) => {
        if (err) {
          console.log("error: ", err);
          result(err, null);
          return;
        }

        console.log("created property: ", { id: res.insertId, ...newProperty });
        result(null, { id: res.insertId, ...newProperty });
      });
    };

    Property.findById = (propertyId, result) => {
      sql.query(`SELECT * FROM properties WHERE id = ${propertyId}`, (err, res) => {
        if (err) {
          console.log("error: ", err);
          result(err, null);
          return;
        }

        if (res.length) {
          console.log("found property: ", res[0]);
          result(null, res[0]);
          return;
        }

        // not found Property with the id
        result({ kind: "not_found" }, null);
      });
    };

    Property.getAll = result => {
      sql.query("SELECT * FROM properties", (err, res) => {
        if (err) {
          console.log("error: ", err);
          result(null, err);
          return;
        }

        console.log("properties: ", res);
        result(null, res);
      });
    };

    Property.updateById = (id, property, result) => {
      sql.query(
        "UPDATE properties SET property_name = ?, address = ?, city = ?, country = ?, minimum_price = ?, maximum_price = ?, ready_to_sell = ? WHERE id = ?",
        [property.property_name, property.address, property.city,property.country, property.minimum_price,property.maximum_price, property.ready_to_sell, id],
        (err, res) => {
          if (err) {
            console.log("error: ", err);
            result(null, err);
            return;
          }

          if (res.affectedRows == 0) {
            // not found Property with the id
            result({ kind: "not_found" }, null);
            return;
          }

          console.log("updated property: ", { id: id, ...property });
          result(null, { id: id, ...property });
        }
      );
    };

    Property.remove = (id, result) => {
      sql.query("DELETE FROM properties WHERE id = ?", id, (err, res) => {
        if (err) {
          console.log("error: ", err);
          result(null, err);
          return;
        }

        if (res.affectedRows == 0) {
          // not found Property with the id
          result({ kind: "not_found" }, null);
          return;
        }

        console.log("deleted property with id: ", id);
        result(null, res);
      });
    };

    Property.removeAll = result => {
      sql.query("DELETE FROM properties", (err, res) => {
        if (err) {
          console.log("error: ", err);
          result(null, err);
          return;
        }

        console.log(`deleted ${res.affectedRows} properties`);
        result(null, res);
      });
    };

    module.exports = Property;

Property model is simple, it contains fields of:

- property_name
- address
- city
- country
- minimum_price
- maximum_price
- ready_to_sell

We use database connection query() method to execute MySQL script: **INSERT, SELECT, UPDATE, DELETE**. You can find more details about the mysql module at: https://www.npmjs.com/package/mysql.

## Let's Jump into Routes

When a client sends request for an endpoint using HTTP request **(GET, POST, PUT, DELETE)**, we need to determine how the server will reponse. It’s why we’re gonna setup the routes.

These are routes we define:

    /properties: GET, POST, DELETE
    /properties/: propertyId: GET, PUT, DELETE

Create a routes folder inside the app folder, then create `property.routes.js` and copy paste the below code.
    
    // routes/property.routes.php

    module.exports = app => {
      const properties = require("../controllers/property.controller.js");

      // Create a new Customer
      app.post("/properties", properties.create);

      // Retrieve all Customers
      app.get("/properties", properties.findAll);

      // Retrieve a single Customer with propertyId
      app.get("/properties/:propertyId", properties.findOne);

      // Update a Customer with propertyId
      app.put("/properties/:propertyId", properties.update);

      // Delete a Customer with propertyId
      app.delete("/properties/:propertyId", properties.delete);

      // Create a new Customer
      app.delete("/properties", properties.deleteAll);
    };

You can see that we use a controller from /controllers/property.controller.js. It contains methods for handling CRUD operations and will be created in the next step.

We also need to include routes in server.js (right before app.listen()):

    ...

    require("./app/routes/property.routes.js")(app);

    app.listen(...);

## Create the Controller

Now we create a controllers folder inside the app folder, then we have a file named `property.controller.js`. Our controller will be written inside this with CRUD functions:

- create
- findAll
- findOne
- update
- delete
- deleteAll
      
Let’s implement these functions.

**Create New Property object**


    const Property = require("../models/property.model.js");

    // Create and Save a new Property
    exports.create = (req, res) => {
      // Validate request
      if (!req.body) {
        res.status(400).send({
          message: "Content can not be empty!"
        });
      }

      // Create a Property
      const property = new Property({
        property_name: req.body.property_name,
        address: req.body.address,
        city: req.body.city,
        country: req.body.country,
        type: req.body.type,
        minimum_price: req.body.minimum_price,
        maximum_price: req.body.maximum_price,
        ready_to_sell:req.body.ready_to_sell
      });

      
**Save Property Object in to the database**

      Property.create(property, (err, data) => {
        if (err)
          res.status(500).send({
            message:
              err.message || "Some error occurred while creating the Property."
          });
        else res.send(data);
      });
    };

**Retrieve all Property Objects from the database.**

    exports.findAll = (req, res) => {
      Property.getAll((err, data) => {
        if (err)
          res.status(500).send({
            message:
              err.message || "Some error occurred while retrieving properties."
          });
        else res.send(data);
      });
    };

**Find a Property Object with a propertyId ( id )**

    exports.findOne = (req, res) => {
      Property.findById(req.params.propertyId, (err, data) => {
        if (err) {
          if (err.kind === "not_found") {
            res.status(404).send({
              message: `Not found Property with id ${req.params.propertyId}.`
            });
          } else {
            res.status(500).send({
              message: "Error retrieving Property with id " + req.params.propertyId
            });
          }
        } else res.send(data);
      });
    };

**Update a Property Object by the propertyId in the request**

    exports.update = (req, res) => {
      // Validate Request
      if (!req.body) {
        res.status(400).send({
          message: "Content can not be empty!"
        });
      }

      console.log(req.body);

      Property.updateById(
        req.params.propertyId,
        new Property(req.body),
        (err, data) => {
          if (err) {
            if (err.kind === "not_found") {
              res.status(404).send({
                message: `Not found Property with id ${req.params.propertyId}.`
              });
            } else {
              res.status(500).send({
                message: "Error updating Property with id " + req.params.propertyId
              });
            }
          } else res.send(data);
        }
      );
    };

**Delete a Property Object with the specified propertyId in the request**

    exports.delete = (req, res) => {
      Property.remove(req.params.propertyId, (err, data) => {
        if (err) {
          if (err.kind === "not_found") {
            res.status(404).send({
              message: `Not found Property with id ${req.params.propertyId}.`
            });
          } else {
            res.status(500).send({
              message: "Could not delete Property with id " + req.params.propertyId
            });
          }
        } else res.send({ message: `Property was deleted successfully!` });
      });
    };

**Delete All Property Objects from the database** - it's very risky to delete all records from Database so this operation isn't required in most of the API implementations.
    
    exports.deleteAll = (req, res) => {
      Property.removeAll((err, data) => {
        if (err)
          res.status(500).send({
            message:
              err.message || "Some error occurred while removing all properties."
          });
        else res.send({ message: `All Properties were deleted successfully!` });
      });
    };

## Test the APIs

Run our Node.js application with command:

    node server.js

    The console shows:

    Server is running on port 3000.
    Successfully connected to the database.


**Using Postman, we’re going to test all the APIs**.

- **Create** a new Property using **POST** [http://localhost:3000/properties/](http://localhost:3000/properties/) endpoint
![Create New Property Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJS-test-1.png)

  After creating some new property, we can check MySQL table:

       SELECT * FROM properties
 
![Create New Property - DB Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-2.png)

- **Retrieve All Properties** using **GET** [http://localhost:3000/properties/](http://localhost:3000/properties/) endpoint
![Retrieve All Properties Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-3.png)

- **Retrieve Single Property by ID** using **GET** [http://localhost:3000/properties/27](http://localhost:3000/properties/27) endpoint
 ![Retrieve All Properties  - DB Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-4.png)

- **Update Property by ID** using **PUT** [http://localhost:3000/properties/27](http://localhost:3000/properties/27) endpoint
 ![Update By PropertyId Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-5.png)

  Check `properties` table after a row was updated:

       SELECT * FROM properties  
 ![Update By PropertyId - DB Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-6.png)      
 


- **Delete Property by ID** using **DELETE** [http://localhost:3000/properties/27](http://localhost:3000/properties/) endpoint
 ![Delete Single Property - Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-7.png)

  Check `properties` table after a row was deleted:

       SELECT * FROM properties
       
 ![Delete Single Property - DB Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-8.png)       

- **Delete All Properties** using **DELETE** [http://localhost:3000/properties/](http://localhost:3000/properties/) endpoint
 ![Delete All Properties - Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-9.png)

  Check `properties` table after all row was deleted:

       SELECT * FROM properties
 ![Delete All Properties - DB Node JS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/NodeJs-test-10.png)
 
 Now there are no rows in properties table:


## What did we learn so far?

So far we’ve learned how to create Node.js REST APIs with an Express web server. We also know how to add configuration for MySQL database, create a model, write a controller, define routes for handling all CRUD operations and execute all test cases using POSTMAN.

I hope instructions are good to set up this project in your local, Enjoy Coding :+1:

![Back to HOME](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples)

## Explore More

- [Express.js Routing](http://expressjs.com/en/guide/routing.html)
- [https://www.npmjs.com/package/express](https://www.npmjs.com/package/express)
- [https://www.npmjs.com/package/body-parser](https://www.npmjs.com/package/body-parser)
- [https://www.npmjs.com/package/mysql](https://www.npmjs.com/package/mysql)


#### For Help, you can reach
-------------------------------
Skype: sapan.mohannty

Twitter: https://twitter.com/htngapi

Linkedin: https://www.linkedin.com/in/travel-technology-cto/
