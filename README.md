# marketplace

## Урок 8. Laravel. Установка окружения. Настройка проекта. Создание первых таблиц.


Создание проекта
> composer create-project laravel/laravel example-app

Создание модели
> php artisan make:model <modelName> --all

Создание миграции
> php artisan make:migration create_product_size_table --create=product_size

Создание смежной таблицы для связи многие ко многим

```php
$table->foreign('category_id')
    ->references('id')
    ->on('categories')
    ->onDelete('cascade');
    
$table->foreign('post_id')
    ->references('id')
    ->on('posts')
    ->onDelete('cascade');
```


php artisan make:resource V1/ProductsResource



### Полезное:
- [Документация laravel](https://laravel.com/docs/10.x/installation)
- [Laravel Связи](https://laravel.com/docs/10.x/installation)
- [Настройка virtual host](https://gist.github.com/bradtraversy/7485f928e3e8f08ee6bccbe0a681a821?permalink_comment_id=4294174)
- [Обзор на СУБД](https://habr.com/en/companies/amvera/articles/754702/)
- [Еще по БД](https://habr.com/en/articles/686816/)
- [Про sql](https://ru.wikipedia.org/wiki/SQL)
- [Типы данных в mysql](https://www.cloud4y.ru/blog/data-types-in-mysql/)

