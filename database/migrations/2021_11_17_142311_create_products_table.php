<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 50)->unique();
            $table->string('name', 50);
            $table->integer('price');
            $table->text('descriptions')->nullable();
            $table->enum('types', ['MAKANAN','MINUMAN']);
            $table->enum('status', ['ACTIVE','NON-ACTIVE'])->default('NON-ACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
