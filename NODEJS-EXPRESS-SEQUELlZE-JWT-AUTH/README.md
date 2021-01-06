# Nodejs Express API Tutorial: Sequelize and JWT - NodeJS Express REST API Examples
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

## What's Sequelize?
Sequelize is a promise-based Node.js ORM for Postgres, MySQL, MariaDB, SQLite and Microsoft SQL Server. It features solid transaction support, relations, eager and lazy loading, read replication and more, [for more details click here](https://sequelize.org/).

## What's JWT?

JWT stand for JSON Web Tokens, are an open, industry standard RFC 7519 method for representing claims securely between two parties. For details [Click Here](https://en.wikipedia.org/wiki/JSON_Web_Token)

If you want to play around with JWT token the here is your [play ground](https://jwt.io/)

### What's Token Based Authentication and how it's different from Session-based Authentication

Comparing with Session-based Authentication that need to store Session on Cookie, the big advantage of Token-based Authentication is that we store the JSON Web Token (JWT) on Client side: Local Storage for Browser, Keychain for IOS and SharedPreferences for Android… So we don’t need to build another backend project that supports Native Apps or an additional Authentication module for Native App users.

### HOW JWT Token look like?

![JWT token with PHP REST API](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Create-REST-API-with-php-oops-1.png)

JWT Token has three parts these are 

- **1 header: ALGORITHM & TOKEN TYPE**, identifies which algorithm is used to generate the signature, HS256 indicates that this token is signed using HMAC-SHA256. Typical cryptographic algorithms used are HMAC with SHA-256 (HS256) and RSA signature with SHA-256 (RS256). JWA (JSON Web Algorithms)
        
        header = {
                    "typ": "JWT",
                    "alg": "HS256"
                 }
- **2 payload: Data**, contains a set of claims. The JWT specification defines seven Registered Claim Names which are the standard fields commonly included in tokens.[1] Custom claims are usually also included, depending on the purpose of the token.              

        payload = {
                    "id": 1,
                    "user_name": "sapan",
                    "email": "ctoattraveltech@gmail.com"
                  } 
- 3 **signature: VERIFY SIGNATURE**, securely validates the token. The signature is calculated by encoding the header and payload using Base64url Encoding and concatenating the two together with a period separator. That string is then run through the cryptographic algorithm specified in the header, in this case HMAC-SHA256. The Base64url Encoding is similar to base64, but uses different non-alphanumeric characters and omits padding.               

        signature = HMACSHA256(
                                base64UrlEncode(header) + "." +
                                base64UrlEncode(payload),
                              )   


        const token = base64urlEncoding(header) + '.' + base64urlEncoding(payload) + '.' + base64urlEncoding(signature)    

final token value is `eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcl9uYW1lIjoic2FwYW4iLCJlbWFpbCI6ImN0b2F0dHJhdmVsdGVjaEBnbWFpbC5jb20ifQ.YuuHvX8IdNFugj0_1xiEbZ9f54PAnaExO9Xv_rjB4Rg`                      



## How to Build NodeJS API with Sequelize and JWT?

To demonstrate how to build a NodeJS Express API with Sequelize and JWT, we'll build an API that will manage for below listed services and that supports Token Based Authentication with JWT ( JSON Web Token ).
- **Token Authentication** 
  - Signup
  - Signin for token and to below property services.
- **Property Services**  
  - Create list of Properties
  - Update Property Details By Id
  - Read Property By Id
  - Read Property Details
  - Delete Property by Id
  - Delete All Properties

Signin process will be providing token and the same token will be used to excute all of properties services ( ex: create, update, read, delete ). Token need to pass through request header to call property services, this scurity layer is very much important to built secure API.

**The Client typically attaches JWT in Authorization header with Bearer prefix:**
    
        Authorization: Bearer [header].[payload].[signature]

**Or only in x-access-token header:**

        x-access-token: [header].[payload].[signature]


This application will list the following about each Property:

- Property Name
- Address
- City
- Country
- Property Type
- Minimum Price
- Maximum Price
- Ready to Sell or not?

## What We will Achieve?

 - Appropriate Flow for User Signup & User Login with JWT Authentication
 - Node.js Express Architecture with CORS, Authenticaton & Authorization middlewares & Sequelize
 - Apply JWT Authentication for Properties CURD services
 - How to configure Express routes to work with JWT
 - How to define Data Models and association for Authentication and Authorization
 - Way to use Sequelize to interact with MySQL Database

## Prerequisites
- Knowledge of NodeJS and Express
- Install NodeJS and Express
- Ensure Mysql Server is Up
- Knowledge of JWT and Sequelize
- [Postman](https://www.postman.com/) or Similar Type of Application ( [REST Client](https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo), [HTTPie](https://httpie.io/) ..) will be needed to test our endpoints

Don't be disappointed if you don't know NodeJS, If you know any programming language that should be fine as well, COOL? 


#### Overview of Node.js Express API Implementation?

- Start With an Express Web Server.
- We Add Configuration for MySQL Database
- Create User and Role Model
- Create Property Model
- Write the Controllers for User, Role, Property
- Then We Define Routes for Handling all CRUD operations with JWT token
- Finally, we’re Gonna to test the Rest APIs using Postman

## What All Endpoints are Available?

**POST	/api/auth/signup** - Signup new account

**POST /api/auth/signin** - Login an account

**GET /api/test/all** - Retrieve public content

**GET /api/test/user** - Access User’s content

**GET /api/test/admin** - Access Admin’s content

**POST /properties** - Create New Property

**GET /properties** - Get All Properties

**GET /properties/27** - Get Single Property with id=27

**PUT /properties/27** - Update Single Property With id=27

**DELETE /properties/27** - Remove Single Property with id=27

**DELETE /properties** - Remove All Properties


## Technology Stack
- Express 4.17.1
- bcryptjs 2.4.3
- jsonwebtoken 8.5.1
- Sequelize 5.21.3
- MySQL

## Project Structure

This is directory structure for our Node.js Express application:

– config

    - configure MySQL database & Sequelize
    - configure Auth Key

– routes

    - auth.routes.js: POST signup & signin
    - user.routes.js: GET public & protected resources
    - property.routes.js: GET, POST & protected resources

– middlewares

    - verifySignUp.js: check duplicate Username or Email
    - authJwt.js: verify Token, check User roles in database

– controllers

    - auth.controller.js: handle signup & signin actions
    - user.controller.js: return public & protected content
    - property.controller.js: return properties content

– models for Sequelize Models

    - user.model.js
    - role.model.js
    - property.model.js

– server.js: import and initialize neccesary modules and routes, listen for connections.


## Create NodeJS REST API

Open terminal/console, then create a folder for our application:

    $ mkdir NODEJS-JWT
    $ cd NODEJS-JWT
    
Then we initialize the Node.js App with a package.json file:

    npm init

    name: (NODEJS-JWT) 
    version: (1.0.0) 
    description: Node.js and Express REST API with JWT Authentication
    entry point: (index.js) server.js
    test command: 
    git repository: 
    keywords: node.js, express, jwt, authentication, mysql
    author: bezkoder
    license: (ISC)

    Is this ok? (yes) yes

**We need to install necessary modules:** `express, cors, body-parser, sequelize, mysql2, jsonwebtoken and bcryptjs`.

Run the command:

    npm install express sequelize mysql2 body-parser cors jsonwebtoken bcryptjs --save

The package.json file now looks like this:

    {
      "name": "NODEJS-JWT",
      "version": "1.0.0",
      "description": "Node.js and Express REST API with JWT Authentication",
      "main": "server.js",
      "scripts": {
        "test": "echo \"Error: no test specified\" && exit 1"
      },
      "keywords": [
        "node.js",
        "jwt",
        "authentication",
        "express",
        "mysql"
      ],
      "author": "Sapan Mohanty",
      "license": "ISC",
      "dependencies": {
        "bcryptjs": "^2.4.3",
        "body-parser": "^1.19.0",
        "cors": "^2.8.5",
        "express": "^4.17.1",
        "jsonwebtoken": "^8.5.1",
        "mysql2": "^2.2.5",
        "sequelize": "^5.22.3"
      },
      "devDependencies": {
        "nodemon": "^2.0.6"
      }
    }

## Setup Express Web Server

**In the root folder, let’s create a new server.js file:**

    const express = require("express");
    const bodyParser = require("body-parser");
    const cors = require("cors");

    const app = express();

    var corsOptions = {
      origin: "http://localhost:8081"
    };

    app.use(cors(corsOptions));

    // parse requests of content-type - application/json
    app.use(bodyParser.json());

    // parse requests of content-type - application/x-www-form-urlencoded
    app.use(bodyParser.urlencoded({ extended: true }));

    // database
    const db = require("./app/models");
    const Role = db.role;

    db.sequelize.sync();
    // force: true will drop the table if it already exists
    // db.sequelize.sync({force: true}).then(() => {
    //   console.log('Drop and Resync Database with { force: true }');
    //   initial();
    // });

    // simple route
    app.get("/", (req, res) => {
      res.json({ message: "Express API is Ready" });
    });

    // routes
    require('./app/routes/auth.routes')(app);
    require('./app/routes/user.routes')(app);
    require('./app/routes/property.routes')(app);

    // set port, listen for requests
    const PORT = process.env.PORT || 8080;
    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}.`);
    });

    function initial() {
      Role.create({
        id: 1,
        name: "user"
      });

      Role.create({
        id: 2,
        name: "admin"
      });
    }
    
    
    
 **Let me explain what we’ve just done?**
– import express, body-parser and cors modules:
- Express is for building the Rest apis
- body-parser helps to parse the request and create the req.body object
- cors provides Express middleware to enable CORS
– create an Express app, then add body-parser and cors middlewares using app.use() method. Notice that we set origin: http://localhost:8081.
– define a GET route which is simple for test.
– listen on port 8080 for incoming requests.

Now let’s run the app with command: nodemon server.js.

Open your browser with url http://localhost:8080/, you will see below screen:


## Configure MySQL database & Sequelize

In the app folder, create config folder for configuration with db.config.js file like this:

        module.exports = {
          HOST: "localhost",
          USER: "root",
          PASSWORD: "",
          DB: "nodejs",
          dialect: "mysql",
          pool: {
            max: 5,
            min: 0,
            acquire: 30000,
            idle: 10000
          }
        };

**First five parameters are for MySQL connection.**
pool is optional, it will be used for Sequelize connection pool configuration:
- max: maximum number of connection in pool
- min: minimum number of connection in pool
- idle: maximum time, in milliseconds, that a connection can be idle before being released
- acquire: maximum time, in milliseconds, that pool will try to get connection before throwing error

For more details, [please visit API Reference for the Sequelize constructor](https://sequelize.org/master/class/lib/model.js~Model.html).

## Define the Sequelize Model

In models folder, create User and Role data model as following code:

**models/user.model.js**

        module.exports = (sequelize, Sequelize) => {
          const User = sequelize.define("users", {
            username: {
              type: Sequelize.STRING
            },
            email: {
              type: Sequelize.STRING
            },
            password: {
              type: Sequelize.STRING
            }
          });

          return User;
        };

**models/role.model.js**

        module.exports = (sequelize, Sequelize) => {
          const User = sequelize.define("users", {
            username: {
              type: Sequelize.STRING
            },
            email: {
              type: Sequelize.STRING
            },
            password: {
              type: Sequelize.STRING
            }
          });

          return User;
        };
        

**models/property.model.js** 

        module.exports = (sequelize, Sequelize) => {
        const Property = sequelize.define("properties", {
                property_name: {
                type: Sequelize.STRING
                },
                address: {
                type: Sequelize.STRING
                },
                city: {
                type: Sequelize.STRING
                },
                country: {
                type: Sequelize.STRING
                },
                minimum_price: {
                type: Sequelize.DECIMAL
                },
                maximum_price: {
                type: Sequelize.DECIMAL
                },
                ready_to_sell: {
                type: Sequelize.INTEGER
                }
                }, {
                timestamps: false
                }); 

        return Property;
        };
        

These Sequelize Models represents users, roles, properties table in MySQL database.

**After initializing Sequelize, we don’t need to write CRUD functions, Sequelize supports all of them:**

        - Create a new User: create(object)
        - Find a User by id: findByPk(id)
        - Find a User by email: findOne({ where: { email: ... } })
        - Get all Users: findAll()
        - Find all Users by username: findAll({ where: { username: ... } 
        - Create a new Property: create(object)
        - Find a Property by id: findByPk(id)
        - Find a Property by id: findOne({ where: { ... } })
        - Get all Properties: findAll()
        - Find all Property by property_name: findAll({ where: { property_name: ... } })


These functions will be used in our Controllers and Middlewares.

## Initialize Sequelize

**Now create app/models/index.js with content like this:**

        const config = require("../config/db.config.js");

        const Sequelize = require("sequelize");
        const sequelize = new Sequelize(
          config.DB,
          config.USER,
          config.PASSWORD,
          {
            host: config.HOST,
            dialect: config.dialect,
            operatorsAliases: false,

            pool: {
              max: config.pool.max,
              min: config.pool.min,
              acquire: config.pool.acquire,
              idle: config.pool.idle
            }
          }
        );

        const db = {};

        db.Sequelize = Sequelize;
        db.sequelize = sequelize;
        db.sequelize = sequelize;


        db.user = require("../models/user.model.js")(sequelize, Sequelize);
        db.role = require("../models/role.model.js")(sequelize, Sequelize);
        db.property = require("../models/property.model.js")(sequelize, Sequelize);


        db.role.belongsToMany(db.user, {
          through: "user_roles",
          foreignKey: "roleId",
          otherKey: "userId"
        });
        db.user.belongsToMany(db.role, {
          through: "user_roles",
          foreignKey: "userId",
          otherKey: "roleId"
        });

        db.ROLES = ["user", "admin"];

        module.exports = db;


**The association between Users and Roles is Many-to-Many relationship:**

– One User can have several Roles.
– One Role can be taken on by many Users.

We use User.belongsToMany(Role) to indicate that the user model can belong to many Roles and vice versa.

With through, foreignKey, otherKey, we’re gonna have a new table user_roles as connection between users and roles table via their primary key as foreign keys.

Don’t forget to call sync() method in `server.js`.

        ...
        const app = express();
        app.use(...);

        const db = require("./app/models");
        const Role = db.role;

        db.sequelize.sync({force: true}).then(() => {
          console.log('Drop and Resync Db');
          initial();
        });

        ...
        function initial() {
          Role.create({
            id: 1,
            name: "user"
          });

          Role.create({
            id: 2,
            name: "admin"
          });  
        }

initial() function helps us to create 3 rows in database.
In development, you may need to drop existing tables and re-sync database. So you can use force: true as code above.

For production, just insert these rows manually and use sync() without parameters to avoid dropping data:

        ...
        const app = express();
        app.use(...);

        const db = require("./app/models");

        db.sequelize.sync();
        ...

## Configure Auth Key

jsonwebtoken functions such as verify() or sign() use algorithm that needs a secret key (as String) to encode and decode token.

In the app/config folder, create auth.config.js file with following code:

        module.exports = {
          secret: "Sapan-Mohanty-secret-key"
        };

You can create your own secret String.

## Create Middleware functions

To verify a Signup action, we need 2 functions:
– check if username or email is duplicate or not
– check if roles in the request is existed or not

    middleware/verifySignUp.js

    const db = require("../models");
    const ROLES = db.ROLES;
    const User = db.user;

    checkDuplicateUsernameOrEmail = (req, res, next) => {
      // Username
      User.findOne({
        where: {
          username: req.body.username
        }
      }).then(user => {
        if (user) {
          res.status(400).send({
            message: "Failed! Username is already in use!"
          });
          return;
        }

        // Email
        User.findOne({
          where: {
            email: req.body.email
          }
        }).then(user => {
          if (user) {
            res.status(400).send({
              message: "Failed! Email is already in use!"
            });
            return;
          }

          next();
        });
      });
    };

    checkRolesExisted = (req, res, next) => {
      if (req.body.roles) {
        for (let i = 0; i < req.body.roles.length; i++) {
          if (!ROLES.includes(req.body.roles[i])) {
            res.status(400).send({
              message: "Failed! Role does not exist = " + req.body.roles[i]
            });
            return;
          }
        }
      }

      next();
    };

    const verifySignUp = {
      checkDuplicateUsernameOrEmail: checkDuplicateUsernameOrEmail,
      checkRolesExisted: checkRolesExisted
    };

    module.exports = verifySignUp;

** To process Authentication & Authorization, we have these functions: **
- check if token is provided, legal or not. We get token from x-access-token of HTTP headers, then use jsonwebtoken's verify() function.
- check if roles of the user contains required role or not.

        const jwt = require("jsonwebtoken");
        const config = require("../config/auth.config.js");
        const db = require("../models");
        const User = db.user;

        verifyToken = (req, res, next) => {
          let token = req.headers["x-access-token"];

          if (!token) {
            return res.status(403).send({
              message: "No token provided!"
            });
          }

          jwt.verify(token, config.secret, (err, decoded) => {
            if (err) {
              return res.status(401).send({
                message: "Unauthorized!"
              });
            }
            req.userId = decoded.id;
            next();
          });
        };

        isAdmin = (req, res, next) => {
          User.findByPk(req.userId).then(user => {
            user.getRoles().then(roles => {
              for (let i = 0; i < roles.length; i++) {
                if (roles[i].name === "admin") {
                  next();
                  return;
                }
              }
              res.status(403).send({
                message: "Require Admin Role!"
              });
              return;
            });
          });
        };
        const authJwt = {
          verifyToken: verifyToken,
          isAdmin: isAdmin
        };
        module.exports = authJwt;

**middleware/index.js**

    const authJwt = require("./authJwt");
    const verifySignUp = require("./verifySignUp");

    module.exports = {
      authJwt,
      verifySignUp
    };

## Create Controllers

**Controller for Authentication**

There are 2 main functions for Authentication:
- signup: create new User in database (role is user if not specifying role)
- signin:
  - Find username of the request in database, if it exists
  - Compare password with password in database using bcrypt, if it is correct
  - Generate a token using jsonwebtoken
  - Return user information & access Token

        controllers/auth.controller.js

        const db = require("../models");
        const config = require("../config/auth.config");
        const User = db.user;
        const Role = db.role;

        const Op = db.Sequelize.Op;

        var jwt = require("jsonwebtoken");
        var bcrypt = require("bcryptjs");

        exports.signup = (req, res) => {
          // Save User to Database
          User.create({
            username: req.body.username,
            email: req.body.email,
            password: bcrypt.hashSync(req.body.password, 8)
          })
            .then(user => {
              if (req.body.roles) {
                Role.findAll({
                  where: {
                    name: {
                      [Op.or]: req.body.roles
                    }
                  }
                }).then(roles => {
                  user.setRoles(roles).then(() => {
                    res.send({ message: "User was registered successfully!" });
                  });
                });
              } else {
                // user role = 1
                user.setRoles([1]).then(() => {
                  res.send({ message: "User was registered successfully!" });
                });
              }
            })
            .catch(err => {
              res.status(500).send({ message: err.message });
            });
        };

        exports.signin = (req, res) => {
          User.findOne({
            where: {
              username: req.body.username
            }
          })
            .then(user => {
              if (!user) {
                return res.status(404).send({ message: "User Not found." });
              }

              var passwordIsValid = bcrypt.compareSync(
                req.body.password,
                user.password
              );

              if (!passwordIsValid) {
                return res.status(401).send({
                  accessToken: null,
                  message: "Invalid Password!"
                });
              }

              var token = jwt.sign({ id: user.id }, config.secret, {
                expiresIn: 86400 // 24 hours
              });

              var authorities = [];
              user.getRoles().then(roles => {
                for (let i = 0; i < roles.length; i++) {
                  authorities.push("ROLE_" + roles[i].name.toUpperCase());
                }
                res.status(200).send({
                  id: user.id,
                  username: user.username,
                  email: user.email,
                  roles: authorities,
                  accessToken: token
                });
              });
            })
            .catch(err => {
              res.status(500).send({ message: err.message });
            });
        };
        
## Controller for Properties


## Controller for testing Authorization

There are 4 functions:
 – /api/test/all for public access
 – /api/test/user for loggedin users (role: user/moderator/admin)
 – /api/test/mod for users having moderator role
 – /api/test/admin for users having admin role

    controllers/user.controller.js

    exports.allAccess = (req, res) => {
      res.status(200).send("Public Content.");
    };

    exports.userBoard = (req, res) => {
      res.status(200).send("User Content.");
    };

    exports.adminBoard = (req, res) => {
      res.status(200).send("Admin Content.");
    };

  

Now, do you have any question? Would you like to know how we can combine middlewares with controller functions?
Let's do it in the next section.

## Define Routes

When a client sends request for an endpoint using HTTP request ( GET, POST, PUT, DELETE ), we need to determine how the server will response by setting up the routes.

We can separate our routes into 2 part: for Authentication and for Authorization (accessing protected resources).

**Authentication:**

- POST /api/auth/signup
- POST /api/auth/signin

    routes/auth.routes.js

    const { verifySignUp } = require("../middleware");
    const controller = require("../controllers/auth.controller");

    module.exports = function(app) {
      app.use(function(req, res, next) {
        res.header(
          "Access-Control-Allow-Headers",
          "x-access-token, Origin, Content-Type, Accept"
        );
        next();
      });

      app.post(
        "/api/auth/signup",
        [
          verifySignUp.checkDuplicateUsernameOrEmail,
          verifySignUp.checkRolesExisted
        ],
        controller.signup
      );

      app.post("/api/auth/signin", controller.signin);
    };

## Authorization:

- GET /api/test/all
- GET /api/test/user for loggedin users (user/admin)
- GET /api/test/admin for admin

**routes/user.routes.js**

    const { authJwt } = require("../middleware");
    const controller = require("../controllers/user.controller");

    module.exports = function(app) {
      app.use(function(req, res, next) {
        res.header(
          "Access-Control-Allow-Headers",
          "x-access-token, Origin, Content-Type, Accept"
        );
        next();
      });

      app.get("/api/test/all", controller.allAccess);

      app.get(
        "/api/test/user",
        [authJwt.verifyToken],
        controller.userBoard
      );     

      app.get(
        "/api/test/admin",
        [authJwt.verifyToken, authJwt.isAdmin],
        controller.adminBoard
      );
    };

Don't forget to add these routes in server.js:

    ...
    // routes
    require('./app/routes/auth.routes')(app);
    require('./app/routes/user.routes')(app);

    // set port, listen for requests
    ...

Run & Test with Results

Run Node.js application with command: nodemon server.js

Tables that we define in models package will be automatically generated in MySQL Database, You can check for console itself.


**What Have We Learned So Far?**

So Far we've learned so many interesting things about Node.js Token Based Authentication with JWT - JSONWebToken in just a Node.js Express REST API Example.
Despite we wrote a lot of code, I hope you understood the overall architecture of the application and hope instructions are good to set up this project in your local and gives you a clarity what can be improved on for your existing project and what to implements on new ones.

Enjoy Coding :+1:

![Back to HOME](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples)

#### For Help, you can reach
-------------------------------
Skype: sapan.mohannty

Twitter: https://twitter.com/htngapi

Linkedin: https://www.linkedin.com/in/travel-technology-cto/


Happy coding
