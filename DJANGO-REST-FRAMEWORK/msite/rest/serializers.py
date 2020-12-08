from rest_framework import serializers

from .models import Register, Store, Book

class BookSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Book
        fields = ('store_id', 'title', 'author', 'isbn', 'release_date')

class StoreSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Store
        fields = ('store_id', 'store_name')

class RegisterSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Register
        fields = ('user_id', 'user_name')
