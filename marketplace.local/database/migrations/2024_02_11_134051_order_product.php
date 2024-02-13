<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('order_id');
            $table->unsignedBiginteger('product_id');
            $table->unsignedBiginteger('color_id');
            $table->unsignedBiginteger('size_id');
            $table->float('price')->default(0);
            $table->integer('count')->default(1);


            $table->foreign('product_id')
                ->references('id')
                ->on('products')->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
