# marketplace

php artisan make:model <modelName> --all


php artisan make:migration create_product_size_table --create=product_size
```
public function up()
{
Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('post_id');

            $table->foreign('category_id')->references('id')
                 ->on('categories')->onDelete('cascade');
            $table->foreign('post_id')->references('id')
                ->on('posts')->onDelete('cascade');
        });
    }
```