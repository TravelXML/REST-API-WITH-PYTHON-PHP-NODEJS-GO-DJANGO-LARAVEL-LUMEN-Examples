#Build Node.Js and Express REST API with Sequelize and JWT

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

We will build REST APIs for **creating, retrieving, updating & deleting  for Property Service** that supports Token Based Authentication with JWT (JSONWebToken).

 ## What's Token Based Authentication and how it's different from Session-based Authentication

Comparing with Session-based Authentication that need to store Session on Cookie, the big advantage of Token-based Authentication is that we store the JSON Web Token (JWT) on Client side: Local Storage for Browser, Keychain for IOS and SharedPreferences for Android… So we don’t need to build another backend project that supports Native Apps or an additional Authentication module for Native App users.

There are three important parts of a JWT: 

1 - Header
2 - Payload
3 - Signature

Together they are combined to a standard structure: header.payload.signature ( 1.2.3 )

The Client typically attaches JWT in Authorization header with Bearer prefix:
    
Authorization: Bearer [header].[payload].[signature]

Or only in x-access-token header:

x-access-token: [header].[payload].[signature]


What We will Achieve?

 - Appropriate Flow for User Signup & User Login with JWT Authentication
 - Node.js Express Architecture with CORS, Authenticaton & Authorization middlewares & Sequelize
 - How to configure Express routes to work with JWT
 - How to define Data Models and association for Authentication and Authorization
 - Way to use Sequelize to interact with MySQL Database
 


#### Overview of Node JS API Implementation?

- Start With an Express Web Server.
- We Add Configuration for MySQL Database
- Create User and Role Model
- Create Property Model
- Write the Controllers for User, Role, Property
- Then We Define Routes for Handling all CRUD operations with JWT token
- Finally, we’re Gonna to test the Rest APIs using Postman

## NodeJS API Routes

**POST	/api/auth/signup**	signup new account

**POST /api/auth/signin**	login an account

**GET	 /api/test/all**	retrieve public content

**GET	 /api/test/user**	access User’s content

**GET	 /api/test/admin**	access Admin’s content

**POST /properties** - Create New Property

**GET /properties**    - Get All Properties

**GET /property/27** - Get Single Property with id=27

**PUT /properties/27** - Update Single Property With id=27

**DELETE /properties/27** - Remove Single Property with id=27

**DELETE /properties** - Remove All Properties



## Create NodeJS REST API

Open terminal/console, then create a folder for our application:

    $ mkdir NODEJS
    $ cd NODEJS
