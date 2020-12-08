from django.db import models
class Store(models.Model):

    store_id = models.AutoField(primary_key=True)
    store_name = models.CharField(max_length=150)
    class Meta:
        # Gives the proper plural name for admin
        verbose_name_plural = "Stores"

    def __str__(self):
        return self.store_name

class Register(models.Model):

    user_id = models.AutoField(primary_key=True)
    user_name = models.CharField(max_length=200, unique = True)
    user_password = models.CharField(max_length=200)
    class Meta:
        # Gives the proper plural name for admin
        verbose_name_plural = "Registers"

    def __str__(self):
        return self.user_name

class Book(models.Model):
    book_id  = models.AutoField(primary_key=True)
    store_id = models.ForeignKey(Store, default=1, verbose_name="Store", on_delete=models.SET_DEFAULT)
    author = models.CharField(max_length=50)
    title = models.CharField(max_length=200)
    isbn = models.CharField(max_length=40, unique = True)
    release_date = models.DateField(null = True)

    class Meta:
        # otherwise we get "Tutorial Seriess in admin"
        verbose_name_plural = "Books"

    def __str__(self):
        return self.title
