package Controllers

import (
	"first-api/Models"
	"fmt"
	"net/http"

	"github.com/gin-gonic/gin"
)

//GetBooks ... Get all books
func GetBooks(c *gin.Context) {
	var book []Models.Book
	err := Models.GetAllBooks(&book)
	if err != nil {
		c.AbortWithStatus(http.StatusNotFound)
	} else {
		c.JSON(http.StatusOK, book)
	}
}

//CreateBook ... Create Book
func CreateBook(c *gin.Context) {
	var book Models.Book
	c.BindJSON(&book)
	err := Models.CreateBook(&book)
	if err != nil {
		fmt.Println(err.Error())
		c.AbortWithStatus(http.StatusNotFound)
	} else {
		c.JSON(http.StatusOK, book)
	}
}

//GetBookByID ... Get the book by id
func GetBookByID(c *gin.Context) {
	id := c.Params.ByName("id")
	var book Models.Book
	err := Models.GetBookByID(&book, id)
	if err != nil {
		c.AbortWithStatus(http.StatusNotFound)
	} else {
		c.JSON(http.StatusOK, book)
	}
}

//UpdateBook ... Update the book information
func UpdateBook(c *gin.Context) {
	var book Models.Book
	id := c.Params.ByName("id")
	err := Models.GetBookByID(&book, id)
	if err != nil {
		c.JSON(http.StatusNotFound, book)
	}
	c.BindJSON(&book)
	err = Models.UpdateBook(&book, id)
	if err != nil {
		c.AbortWithStatus(http.StatusNotFound)
	} else {
		c.JSON(http.StatusOK, book)
	}
}

//DeleteBook ... Delete the book
func DeleteBook(c *gin.Context) {
	var book Models.Book
	id := c.Params.ByName("id")
	err := Models.DeleteBook(&book, id)
	if err != nil {
		c.AbortWithStatus(http.StatusNotFound)
	} else {
		c.JSON(http.StatusOK, gin.H{"id" + id: "is deleted"})
	}
}
