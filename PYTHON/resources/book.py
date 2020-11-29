from flask_restful import Resource, reqparse
from flask_jwt import jwt_required
from models.book import BookModel


class Book(Resource):
    parser = reqparse.RequestParser()
    parser.add_argument('price',
                        type=float,
                        required=True,
                        help="This field cannot be left blank!"
                        )
    parser.add_argument('store_id',
                        type=int,
                        required=True,
                        help="Every item needs a store_id."
                        )
    parser.add_argument('author',
                        type=str,
                        required=True,
                        help="Every item needs a author."
                        )
    parser.add_argument('isbn',
                        type=str,
                        required=True,
                        help="Every item needs a isbn."
                        )
    parser.add_argument('release_date',
                        type=str,
                        required=False
                        )

    @jwt_required()
    def get(self, title):
        book = BookModel.find_by_title(title)
        if book:
            return book.json()
        return {'message': 'book not found'}, 404

    def post(self, title):
        if BookModel.find_by_title(title):
            return {'message': "An book with title '{}' already exists.".format(title)}, 400

        data = Book.parser.parse_args()
        book = BookModel(title, **data)
        try:
            book.save_to_db()
        except:
            return {"message": "An error occurred inserting the book."}, 500

        return book.json(), 201

    def delete(self, title):
        book = BookModel.find_by_title(title)
        if book:
            book.delete_from_db()
            return {'message': 'Item deleted.'}
        return {'message': 'Item not found.'}, 404

    def put(self, title):
        data = Book.parser.parse_args()

        book = BookModel.find_by_title(title)

        if book:
            book.price = data['price']
        else:
            book = BookModel(title, **data)

        book.save_to_db()

        return book.json()


class BookList(Resource):
    def get(self):
        return {'books': list(map(lambda x: x.json(), BookModel.query.all()))}
