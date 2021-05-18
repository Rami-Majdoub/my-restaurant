# About this project
This project was an initiative to explore the PHP world and Laravel Super Powers.

# Tutorials
[Laravel From Scratch - youtube]()
[laracasts](https://laracasts.com/series/laravel-5-fundamentals/episodes/22?autoplay=true)
[](https://jsfiddle.net/nsdont/pu6yhbxy/4/)

# Used commands
````bash
# start server
php artisan serve

# create a new table in the database
php artisan make:model Bill -m

# create crud controller
php artisan make:controller BillsController --resource

# create many to many table
php artisan make:migration create_bill_product_table --create=bill_product

# run migration
php artisan migrate

````

````bash
# create a row in the database
php artisan tinker

````
````php
$product = new App\Models\Product();
$product->title = 'Coffee';
$product->description = 'description';
$product->price = 1.0;
$product->save();
````
