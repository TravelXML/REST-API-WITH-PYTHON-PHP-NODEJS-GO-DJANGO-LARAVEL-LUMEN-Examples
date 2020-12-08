from django.shortcuts import render

# Create your views here.
from rest_framework import viewsets

from .serializers import BookSerializer, StoreSerializer, RegisterSerializer
from .models import Book, Store, Register


class BookViewSet(viewsets.ModelViewSet):
    queryset = Book.objects.all().order_by('title')
    serializer_class = BookSerializer

class StoreViewSet(viewsets.ModelViewSet):
    queryset = Store.objects.all().order_by('store_name')
    serializer_class = StoreSerializer

class RegisterViewSet(viewsets.ModelViewSet):
    queryset = Register.objects.all().order_by('user_name')
    serializer_class = RegisterSerializer
