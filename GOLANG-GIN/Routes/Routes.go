package Routes

import (
	"first-api/Controllers"

	"github.com/gin-gonic/gin"
)

//SetupRouter ... Configure routes
func SetupRouter() *gin.Engine {
	r := gin.Default()
	grp1 := r.Group("/book-store")
	{
		grp1.GET("book", Controllers.GetBooks)
		grp1.POST("book", Controllers.CreateBook)
		grp1.GET("book/:id", Controllers.GetBookByID)
		grp1.PUT("book/:id", Controllers.UpdateBook)
		grp1.DELETE("book/:id", Controllers.DeleteBook)
	}
	return r
}
