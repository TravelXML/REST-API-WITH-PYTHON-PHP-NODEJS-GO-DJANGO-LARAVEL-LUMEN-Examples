# Laravel API Tutorial: Build a Secure REST API in PHP Using Laravel, Passport, oauth2.0

![Laravel REST API with OAUTH2.0](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/BUILD-REST-API-laravel.jpg)

[RESTful APIs](https://en.wikipedia.org/wiki/Representational_state_transfer) are very vital when building back-end resources for a mobile application or using any of the modern JavaScript frameworks. If by chance you are unaware, an API is an interface or code in this case, that allows two software programs to communicate with each other. Notably, it does not maintain session state between requests, hence, you will need to use tokens to authenticate and authorize users of your application.

## What's Laravel?

[Laravel](https://laravel.com/) is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.

## What's Passport?

[Laravel Passport](https://laravel.com/docs/8.x/passport#introduction) provides a full OAuth2 server implementation for your Laravel application in a matter of minutes. Passport is built on top of the League OAuth2 server.

## What to choose Passport Or Sanctum For API Development?

If your application absolutely needs to support OAuth2, **in-case API development you should use Laravel Passport**.

However, if you are attempting to authenticate a single-page application, mobile application, or issue API tokens, you should use Laravel Sanctum. Laravel Sanctum does not support OAuth2; however, it provides a much simpler API authentication development experience.


**Laravel makes building such a resource easy with a predefined provision for you to secure it appropriately**. This tutorial will teach you how to build and secure your Laravel back-end API using [Laravel passport](https://laravel.com/docs/8.x/passport). When we are finished, you will have learned how to secure your new Laravel API or provide an extra layer of security to existing ones.

## Prerequisites
- Knowledge of PHP OOPS
- Basic knowledge of building applications with Laravel will be of help in this tutorial
- Ensure that you have installed Composer globally to manage dependencies
- Ensure Mysql Server is Up
- Postman or similar type of application ( REST Client, HTTPie ..) will be needed to test our endpoints

## How to Start?
To demonstrate how to build a secure Laravel API with passport token, we'll build an API that will be used to create a list of properties. This application will list the following about each Property:
- Property Name
- Address
- City
- Country
- Property Type
- Minimum Price
- Maximum Price
- Ready to Sell or not?

To Build this REST API, we will install Laravel Passport and generate an access token for each user after authentication. This will allow such users to have access to some of the secured endpoints.
Don't be disappointed if you don't know PHP, If you know any programming language that should be fine as well, COOL?

## Let's Start?

To begin, you can either use Composer or Laravel installer to quickly scaffold a new Laravel application on your computer. Follow the instructions here on [Laravel's official website to set up the Laravel installer](https://laravel.com/docs/8.x/). 
Once you are done, run the following command:

    // move into the project
    $ laravel new pms-api
    // run the application
    $ composer create-project - prefer-dist laravel/laravel pms-api
    
Depending on your preferred choice, the preceding commands will create a new folder named pms-api within the development folder, where you installed Laravel and its dependencies in.
You can move into the newly created folder and run the application using the in built-in Laravel Artisan command as shown here:
    
    // move into the project
    $ cd pms-api

    // run the application
    $ php artisan serve
    
Navigate to http://127.0.0.1:8000 from your browser to view the welcome page:
![Larvel Server Up Now](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/laravel-1.png)
Laravel Server is Up Now

## Create a Database and Connect to It

Now that Laravel is installed and running, the next step is to create a connection to your database. First, ensure that you have created a database and then update the values of the following variables within the .env file:
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

The database is all set, but before we start building our API, we need to install and configure Laravel Passport.

## Install And Configure Laravel Passport

Laravel Passport provides a full 0Auth2 server implementation for Laravel applications. With it, you can easily generate a personal access token to uniquely identify a currently authenticated user. This token will then be attached to every request allowing each user access protected routes. To begin, stop the application from running by hitting CTRL + C on your computer's keyboard and install Laravel Passport using Composer as shown here:
    
    
    $ composer require laravel/passport
    
    //Once the installation is complete, a new migration file containing the tables needed to store clients and access tokens will have been generated for your application. Run the following command to migrate your database:
    
    $ php artisan migrate
    
    //Next, to create the encryption keys needed to generate secured access tokens, run the command below:
    
    $ php artisan passport:install
    
    
Immediately after the installation process from the preceding command is finished, add the Laravel\Passport\HasApiTokens trait to your App\User model as shown here:
    
    
    // app/User.php
    <?php
    namespace App;
    ...
    use Laravel\Passport\HasApiTokens; // include this

    class User extends Authenticatable
    {
        use Notifiable, HasApiTokens; // update this line

        ...
    }

One of the benefits of this trait is the access to a few helper methods that your model can use to inspect the authenticated user's token and scopes.
Now, to register the routes necessary to issue and revoke access tokens (personal and client), you will call the Passport::routes method within the boot method of your AuthServiceProvider. To do this, open the app/Providers/AuthServiceProvider file and update its content as shown below:


    // app/Providers/AuthServiceProvider.php
    <?php
    namespace App\Providers;
    use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
    use Illuminate\Support\Facades\Gate;
    use Laravel\Passport\Passport; // add this 
    class AuthServiceProvider extends ServiceProvider
    {
        /**
         * The policy mappings for the application.
         *
         * @var array
         */
        protected $policies = [
             'App\Model' => 'App\Policies\ModelPolicy', // uncomment this line
        ];

        /**
         * Register any authentication / authorization services.
         *
         * @return void
         */
        public function boot()
        {
            $this->registerPolicies();

            Passport::routes(); // Add this
        }
    }
    
    
After registering Passport::routes(), Laravel Passport is almost ready to handle all authentication and authorization processes within your application.
Finally, for your application to be ready to use Passport's TokenGuard
to authenticate any incoming API requests, open the config/auth configuration file and set the  driver option of the api authentication guard to passport:
        
        // config/auth

        <?php

        return [
            ...

            'guards' => [
                'web' => [
                    'driver' => 'session',
                    'provider' => 'users',
                ],

                'api' => [
                    'driver' => 'passport', // set this to passport
                    'provider' => 'users',
                    'hash' => false,
                ],
            ],

            ...
        ];

## Create a Migration File for the Property

Every new installation of Laravel comes with a pre-generated User model and migration file. This is useful for maintaining a standard database structure for your database. Open the app/User.php  file and ensure that it is similar to this:

        // app/User.php

        <?php

        namespace App;

        use Illuminate\Contracts\Auth\MustVerifyEmail;
        use Illuminate\Foundation\Auth\User as Authenticatable;
        use Illuminate\Notifications\Notifiable;
        use Laravel\Passport\HasApiTokens;

        class User extends Authenticatable
        {
            use Notifiable, HasApiTokens;

            /**
             * The attributes that are mass assignable.
             *
             * @var array
             */
            protected $fillable = [
                'name', 'email', 'password',
            ];

            /**
             * The attributes that should be hidden for arrays.
             *
             * @var array
             */
            protected $hidden = [
                'password', 'remember_token',
            ];

            /**
             * The attributes that should be cast to native types.
             *
             * @var array
             */
            protected $casts = [
                'email_verified_at' => 'datetime',
            ];
        }

Also for the user migration file in database/migrations/***_create_users_table.php:

        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        class CreateUsersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create('users', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('email')->unique();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->string('password');
                    $table->rememberToken();
                    $table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('users');
            }
        }

The fields specified in the file above will suffice for the credentials required from the users of our application, hence there will be no need to modify it.
Next, we will use the artisan command to create a model instance and generate a database migration file for the Property table:

    $ php artisan make:model Property -m

The preceding command will create a model within the app directory and a new migration file in database/migrations folder. The -m  option is short for --migration and  it tells the artisan command to create a migration file for our model.  Next, open the newly created migration file and update its content as  shown here:

      <?php
      use Illuminate\Database\Migrations\Migration;
      use Illuminate\Database\Schema\Blueprint;
      use Illuminate\Support\Facades\Schema;
      class CreatePropertiesTable extends Migration{
      /*** Run the migrations.
      *
      * @return void
      */
      public function up()
      {
        Schema::create('properties', function (Blueprint $table) {
         $table->id();
         $table->string('property_name');
         $table->string('address');
         $table->string('city');
         $table->string('country');
         $table->string('type');
         $table->float('minimum_price');
         $table->float('maximum_price');
         $table->integer('ready_to_sell');
         $table->timestamps();
        });
      }
      /**
      * Reverse the migrations.
      *
      * @return void
      */
        public function down() {
      Schema::dropIfExists('properties');
       }
    }
    
Here, we included property_name, address, city, country , type, minimum_price , maximum_priceand ready_to_sellfields.
Now open the app/Property.php file and use the following content for it:

    <?php
    namespace App;
    use Illuminate\Database\Eloquent\Model;
    class Property extends Model
    {
    protected $fillable = ['property_name', 'address', 'city', 'country','type','minimum_price','maximum_price','ready_to_sell'];
    }
    
Here, we specified the attributes that should be mass assignable, as all Eloquent models protect against mass-assignment by default.
Run the migration command again to update the database with the newly created table and fields using the following command:

    $ php artisan migrate

Now that the database is updated, we will proceed to create controllers for the application. We will also create a couple of endpoints that will handle registration, login, and creating the details of a CEO as explained earlier.

## Create Controllers

Controllers accept incoming HTTP requests and redirect them to the appropriate action or methods to process such requests and return the appropriate response. Since we are building an API, most of the responses will be in JSON format. This is mostly considered the standard format for RESTful APIs.
Authentication controller
We will start by using the artisan command to generate an Authentication Controller for  our application. This controller will process and handle requests for  registration and login for a user into the application.

    $ php artisan make:controller API/AuthController

This will create a new API folder within app/Http/Controllers and then creates a new file named AuthController.php within it. Open the newly created controller file and use the following content for it:
    
    <?php
    namespace App\Http\Controllers\API;
    use App\Http\Controllers\Controller;
    use App\User;
    use Illuminate\Http\Request;
    class AuthController extends Controller
    {
        public function register(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|max:55',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed'
            ]);
            $validatedData['password'] = bcrypt($request->password);
            $user = User::create($validatedData);
            $accessToken = $user->createToken('authToken')->accessToken;
            return response([ 'user' => $user, 'access_token' => $accessToken]);
        }
        public function login(Request $request)
        {
            $loginData = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            if (!auth()->attempt($loginData)) {
                return response(['message' => 'Invalid Credentials']);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        }
    }
    
The register method  above handled the registration process for users of our application. To  handle validation and ensure that all the required fields for  registration are filled, we used Laravel's validation method. This validator will ensure that the name, email, password and password_confirmation fields are required and return the appropriate feedback.

Lastly, the login method ensures that the appropriate credentials are inputted before authenticating a user. If authenticated successfully, an accessToken is  generated to uniquely identify the logged in user and send a JSON  response. Any subsequent HTTP requests sent to a secured or protected  route will require that the generated accessToken be passed  as an Authorization header for the process to be successful. Otherwise,  the user will receive an unauthenticated response.

## Creating the Property Controller

Here, you will use the same artisan command to automatically create a new controller. This time around we will create an API resource controller.  Laravel resource controllers are controllers that handle all HTTP  requests for a particular Model. In this case, we want to create a  controller that will handle all requests for the Property model, which include creating, reading, updating, and deleting. To achieve this, run the following command:

    $ php artisan make:controller API/PropertyController --api --model=Property

The command above will generate an API resource controller that does not include the create and edit view since we are only building APIs. 
Navigate to `app/Http/Controllers/API/PropertyController.php` and update its contents as shown below:

      namespace App\Http\Controllers\API;
      use App\Property;
      use App\Http\Controllers\Controller;
      use App\Http\Resources\PropertyResource;
      use Illuminate\Http\Request;
      use Illuminate\Support\Facades\Validator;
      class PropertyController extends Controller
      {
      /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
          public function index()
          {
              $propertys = Property::all();
              return response([ 'propertys' => PropertyResource::collection($propertys), 'message' => 'Retrieved successfully'], 200);
          }
      /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
          public function store(Request $request)
          {
          $data = $request->all();
          $validator = Validator::make($data, [
                  'name' => 'required|max:255',
                  'year' => 'required|max:255',
                  'company_headquarters' => 'required|max:255',
                  'what_company_does' => 'required'
                ]);
          if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
          }
            $property = Property::create($data);
            return response([ 'property' => new PropertyResource($property), 'message' => 'Created successfully'], 200);
          }
      /**
      * Display the specified resource.
      *
      * @param  \App\Property  $property
      * @return \Illuminate\Http\Response
      */
          public function show(Property $property)
          {
            return response([ 'property' => new PropertyResource($property), 'message' => 'Retrieved successfully'], 200);
          }

      /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Property  $property
      * @return \Illuminate\Http\Response
      */
          public function update(Request $request, Property $property)
          {
              $property->update($request->all());
              return response([ 'property' => new PropertyResource($property), 'message' => 'Retrieved successfully'], 200);
          }
      /**
      * Remove the specified resource from storage.
      *
      * @param \App\Property $property
      * @return \Illuminate\Http\Response
      * @throws \Exception
      */
          public function destroy(Property $property)
          {
              $property->delete();
              return response(['message' => 'Deleted']);
          }
      }
      
A quick view at the code snippet above shows that we created five different methods; each housing logic to carry out a particular function. 
Here is an overview of what each method does:
- `index:` This method retrieves the entire list of Properties from the database and returns it as a resource collection in a JSON  structure. More details about the Laravel resource collection will be shared in the next section.
- `store:` This method receives the instance of the HTTP request to create new Property details via dependency injection using $request to  retrieve all the values posted. It also ensures that all the required  fields are not submitted as an empty request. Lastly, it returns the  information of the newly created Property details as a JSON response.
- `show:` This method uniquely identifies a particular Property and returns the details as a JSON response.
- `update:` This receives the HTTP request and the  particular item that needs to be edited as a parameter. It runs an  update on the instance of the model passed into it and returns the  appropriate response.
- `destroy:` This method receives the instance of a particular item that needs to be deleted and removes it from the database.

Some methods require a specific model ID to uniquely verify an item such as show() , update(), and destroy(). One thing to note here is that we were able to inject the model instances directly. This is due to using implicit route model binding in Laravel.
Once in place, Laravel will help to inject the instance Property into our methods and return a 404 status  code if not found. This makes it very easy to use the instance of the  model directly, without necessarily running a query to retrieve the  model that corresponds to that ID.
You can read more about implicit route model binding here on the official documentation of Laravel.

##  Create a Resource

Laravel Eloquent resources allow you to convert your models and collections into JSON format. It works as a data transformation layer between the database and the controllers. This helps provide a uniform interface that can be used wherever you need it within your application. Let's create one for our CEO model by using the following command:

    $ php artisan make:resource PropertyResource

This will create a new resource file named PropertyResource.php within the app/Http/Resources directory. Go ahead and open the newly created file. The content will look like this:
                
    <?php
    namespace App\Http\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;
    class PropertyResource extends JsonResource{
      /**
      * Transform the resource into an array.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return array
      */
     public function toArray($request){
      return parent::toArray($request);
     }
    }
                
The parent::toArray($request) inside the toArray() method will automatically convert all visible model attributes as part of the JSON response.
Gain a deeper understanding of the benefits offered by Eloquent resources here.

## Update Routes File

To complete the set up of the endpoints for the methods created within our controllers, update the routes.php file with the following contents:
  
    Route::post('/register', 'Api\AuthController@register');
    Route::post('/login', 'Api\AuthController@login');
    Route::apiResource('/property', 'Api\PropertyController')->middleware('auth:api');

To view the entire list of the routes created for this application, run the following command from the terminal:
    
    $ php artisan route:list
    
![php artisan route:list](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/laravel-2.png)    
    
You will see similar contents as shown above:

## Run the Application

Now, test all the logic implemented so far by running the application with:

    $ php artisan serve
    
We will use Postman for the remainder of this tutorial to test the endpoints. [Download it here if you don't have it installed on your machine](https://www.postman.com/).

## Register User

To register a user, send a POST HTTP request to this endpoint http://127.0.0.1:8000/api/register and input the appropriate details as shown here:

![Laravel API Register user](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Register.png)  

## Register User Keys

Now, your details might not be similar to this, but here is what the key and value of your requests should look like:
![Laravel API Register User Keys](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Register-keys.png) 

## Login

Once the registration is successful, you can proceed to http://127.0.0.1:8000/api/login and enter your details to get authenticated:
![Laravel API Login](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Login.png)

Now, assuming that you used the same key and value specified in the previous section, your request should be similar to this:
![Laravel API Login](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/login-keys.png)

## Add Bearer Token

After the login, copy the value of the access_token from the response and click on the Authorization tab and select Bearer Token from the dropdown and paste the value of the access_token copied earlier:
![Laravel API Bearer Token](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/token.png)

## Create Property

Create a new Property by sending a POST HTTP request to this endpoint http://127.0.0.1:8000/api/property as shown  below:

![Laravel API Create Property](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Property-create.png)

## Fetch the list of Properties

Fetch the list of Properties created so far, send a GET HTTP request to this endpoint http://127.0.0.1:8000/api/property as shown  below:
![Laravel API Fetch the list of Properties](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/property-fetch.png)

## Update Property

Update the details of a particular property by sending a PATCH HTTP request to this URL http://127.0.0.1:8000/api/property/1:
![Laravel API Update Property](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/property-update.png)

## Delete Property

Delete the details of a particular property by sending a DELETE HTTP request to this URL http://127.0.0.1:8000/api/property/1 :

![Laravel API Delete Property](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/property-delete.png)

Here deleting property, which has propety_id:1, it has been passed over parameter

## Conclusion

Now we have learned how to [Build any RESTful API with Laravel using Laravel Passport](https://apige.medium.com/laravel-api-tutorial-build-a-secure-rest-api-in-php-using-laravel-passport-oauth2-0-f74d1f78c01a). The example covers the basic CRUD operations ( create, read, update and delete ) those operations are required by most of applications.

I hope instructions are good to set up this project in your local and gives you a clarity what can be improved on for your existing project and what to implements on new ones, Enjoy Coding :+1:

![Back to HOME](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples)

#### For Help, you can reach
-------------------------------
Skype: sapan.mohannty

Twitter: https://twitter.com/htngapi

Linkedin: https://www.linkedin.com/in/travel-technology-cto/

