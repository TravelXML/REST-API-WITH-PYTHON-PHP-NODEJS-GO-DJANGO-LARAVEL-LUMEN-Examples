# Book Data API

This is a sample application showing how to build rest api using golang.

## Run Locally

To run, from the root of the repo

```
go run .
```

## Access the app 

The App has a few Endpoints

All api endpoints are prefixed with `/api/v1`

To reach any endpoint use `baseurl:8080/api/v1/{endpoint}`



Get Books by Author: "/books/authors/{author}" 
Optional query parameter for ratingAbove ratingBelow limit and skip

Get Books by BookName: "/books/book-name/{bookName}"
Optional query parameter for ratingAbove ratingBelow limit and skip


Get Book by ISBN: "/book/isbn/{isbn}"

Delete Book by ISBN "/book/isbn/{isbn}"

Create New Book "/book"
```

