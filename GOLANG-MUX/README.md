# BUILD REST API using GO & MUX - with CSV

![REST API With GO and MUX](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Build-REST-API-USING-GO-MUX.png)

## Why to Build REST API with GO?<img align="right" width="100px" src="https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/go.png">

**Go** is the trending programming language currently. Go is very simple but offers similar performance to those low level languages like **C++**. Go is referred to be the fastest programming language that offers very high performance. 

### Let’s Go!

Wow it sounds cool with GO, isn’t it?

## Install Go

You will find a lot of materials teaching you how to install Go in your machine. I believe that you have already installed Go in your machine because we are going to write the intermediate code for Go. Even if you have not installed it yet, you can install it now. 

## How to Install Go?

1 — Navigate to this URL: https://golang.org/doc/install

2 — You will find your operating system on the page.

![Go Installation](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Go-installation.png)


If you don’t see your operating system there? [Try one of the other downloads](https://golang.org/dl/).

Run the installer file, whenever you have completed installation of Go or you have Go on your machine, please test whether it is working or not, by simply checking the version.

3 — Run Below Command
```
go version
```
You will see similar screen shown in below:

![Go Installation Version](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/blob/main/images/go-version.png)

It will return GO installed Version, in my case it is  `go1.15.6`


### This is a sample Book REST API which will showcase you, how to build REST API using golang & MUX.

## What's MUX? ![GO-MUX](https://camo.githubusercontent.com/a62a5e2040257dd8787001ffa5d95964d7bc77024aa2ba3d94e64ec1e151228e/68747470733a2f2f636c6f75642d63646e2e7175657374696f6e61626c652e73657276696365732f676f72696c6c612d69636f6e2d36342e706e67)

The name mux stands for "HTTP request multiplexer". Like the standard http.ServeMux, mux.Router matches incoming requests against a list of registered routes and calls a handler for the route that matches the URL or other conditions for more details ![Click Here](https://github.com/gorilla/mux)


## How to Run Locally?

Download the script to your local project folder from ![repository](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/GOLANG-MUX) then from the root of the project folder run the below command.

```
go run .
```

then server will run without any issues

![REST API GOlang](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/go-mux-1.png)

## What all endpoints will available?


The App has a few Endpoints

All api endpoints are prefixed with `/api/v1` because in router we set like this, if you will open main.go file then on the below section you will find router section

  
  ```
  func main() {
	r := mux.NewRouter()
	log.Println("bookdata api")
	api := r.PathPrefix("/api/v1").Subrouter()
	api.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		fmt.Fprintln(w, "api v1")
	})
	api.HandleFunc("/books/authors/{author}", searchByAuthor).Methods(http.MethodGet)
	api.HandleFunc("/books/book-name/{bookName}", searchByBookName).Methods(http.MethodGet)
	api.HandleFunc("/book/isbn/{isbn}", searchByISBN).Methods(http.MethodGet)
	api.HandleFunc("/book/isbn/{isbn}", deleteByISBN).Methods(http.MethodDelete)
	api.HandleFunc("/book", createBook).Methods(http.MethodPost)
	log.Fatalln(http.ListenAndServe(":8080", r))
}
```
You can restructure all endpoints according to your requirements.

### To reach any endpoint use `baseurl:8080/api/v1/{endpoint}`

Get Books by Author: `/books/authors/{author}` 
Optional query parameter for ratingAbove ratingBelow limit and skip

![REST API GOlang](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/go-mux-2.png)

Get Books by BookName: `/books/book-name/{bookName}`
Optional query parameter for ratingAbove ratingBelow limit and skip


Get Book by ISBN: `/book/isbn/{isbn}`

Delete Book by ISBN `/book/isbn/{isbn}`

Create New Book `/book`

I hope instructions are good to set up this project in your local, Enjoy Coding :+1:

![Back to HOME](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples)

#### For Help, you can reach
-------------------------------
Skype: sapan.mohannty

Twitter: https://twitter.com/htngapi

Linkedin: https://www.linkedin.com/in/travel-technology-cto/

