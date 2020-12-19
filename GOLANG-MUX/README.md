# Book Data API - GO - MUX - with CSV

![REST API With GO and MUX](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Build-REST-API-USING-GO-MUX.png)

This is a sample application showing how to build rest api using golang & MUX.

# What's MUX?

The name mux stands for "HTTP request multiplexer". Like the standard http.ServeMux, mux.Router matches incoming requests against a list of registered routes and calls a handler for the route that matches the URL or other conditions for more details ![Click Here](https://github.com/gorilla/mux)


## How to Run Locally?

Download the script to your local project folder from repositories then from the root of the project folder run the below command.

```
go run .
```

then server will run without any issues

![REST API GOlang](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/go-mux-1.png)

## What all end points will available?


The App has a few Endpoints

All api endpoints are prefixed with `/api/v1`

To reach any endpoint use `baseurl:8080/api/v1/{endpoint}`

Get Books by Author: `/books/authors/{author}` 
Optional query parameter for ratingAbove ratingBelow limit and skip

![REST API GOlang](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/go-mux-2.png)

Get Books by BookName: `/books/book-name/{bookName}`
Optional query parameter for ratingAbove ratingBelow limit and skip


Get Book by ISBN: `/book/isbn/{isbn}`

Delete Book by ISBN `/book/isbn/{isbn}`

Create New Book `/book`

