package Models

import "time"

type Book struct {
	Id           uint      `json:"id"`
	title        string    `json:"title"`
	Author       string    `json:"author"`
	Description  string    `json:"description"`
	Price        float64   `json:"price"`
	Isbn         string    `json:"isbn"`
	Release_date time.Time `json:"release_date"`
}

func (b *Book) TableName() string {
	return "book"
}
