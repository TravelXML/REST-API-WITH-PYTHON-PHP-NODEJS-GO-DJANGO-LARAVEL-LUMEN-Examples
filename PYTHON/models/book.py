from db import db


class BookModel(db.Model):
    __tablename__ = 'books'

    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(80))
    author = db.Column(db.String(80))
    isbn = db.Column(db.String(40))
    release_date = db.Column(db.String(10))
    price = db.Column(db.Float(precision=2))
    store_id = db.Column(db.Integer, db.ForeignKey('stores.id'))
    store = db.relationship('StoreModel')

    def __init__(self, title, price, store_id, author, isbn, release_date):
        self.title = title
        self.price = price
        self.store_id = store_id
        self.author = author
        self.isbn = isbn
        self.release_date = release_date

    def json(self):
        return {'title': self.title, 'price': self.price, 'author': self.author, 'isbn': self.isbn, 'release_date': self.release_date}

    @classmethod
    def find_by_title(cls, title):
        return cls.query.filter_by(title=title).first()

    def save_to_db(self):
        db.session.add(self)
        db.session.commit()

    def delete_from_db(self):
        db.session.delete(self)
        db.session.commit()
