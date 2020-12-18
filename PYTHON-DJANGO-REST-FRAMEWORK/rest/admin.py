from django.contrib import admin

# Register your models here.
#from .models import Hero
#admin.site.register(Hero)

#from .models import Book
#admin.site.register(Book)
#from .models import Tutorial, TutorialSeries, TutorialCategory
#class TutorialAdmin(admin.ModelAdmin):

    # fieldsets = [
    #     ("Title/date", {'fields': ["tutorial_title", "tutorial_published"]}),
    #     ("URL", {'fields': ["tutorial_slug"]}),
    #     ("Series", {'fields': ["tutorial_series"]}),
    #     ("Content", {"fields": ["tutorial_content"]})
    # ]
    #
    # formfield_overrides = {
    #     models.TextField: {'widget': TinyMCE(attrs={'cols': 80, 'rows': 30})},
    #     }


#admin.site.register(TutorialSeries)
#admin.site.register(TutorialCategory)
#admin.site.register(Tutorial)
from .models import Register, Store, Book

class BookAdmin(admin.ModelAdmin):
    list_display = ("store_id", "title", "author", "isbn", "release_date")

class StoreAdmin(admin.ModelAdmin):
    list_display = ("store_id", "store_name")

class userAdmin(admin.ModelAdmin):
    list_display = ("user_id", "user_name", "user_password")


admin.site.register(Register, userAdmin)
admin.site.register(Store, StoreAdmin)
admin.site.register(Book, BookAdmin)
