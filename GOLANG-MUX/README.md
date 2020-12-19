# BUILD REST API using GO & MUX - with CSV

![REST API With GO and MUX](https://raw.githubusercontent.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/main/images/Build-REST-API-USING-GO-MUX.png)

### This is a sample Book REST API which will showcase you, how to build REST API using golang & MUX.

## What's MUX?

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
You can restructure this according to your requirements.

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

