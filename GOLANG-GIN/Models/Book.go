package Models

import (
	"first-api/Config"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

//GetAllBooks Fetch all book data
func GetAllBooks(book *[]Book) (err error) {
	if err = Config.DB.Find(book).Error; err != nil {
		return err
	}
	return nil
}

//CreateBook ... Insert New data
func CreateBook(book *Book) (err error) {
	if err = Config.DB.Create(book).Error; err != nil {
		return err
	}
	return nil
}

//GetBookByID ... Fetch only one book by Id
func GetBookByID(book *Book, id string) (err error) {
	if err = Config.DB.Where("id = ?", id).First(book).Error; err != nil {
		return err
	}
	return nil
}

//UpdateBook ... Update book
func UpdateBook(book *Book, id string) (err error) {
	fmt.Println(book)
	Config.DB.Save(book)
	return nil
}

//DeleteBook ... Delete book
func DeleteBook(book *Book, id string) (err error) {
	Config.DB.Where("id = ?", id).Delete(book)
	return nil
}
