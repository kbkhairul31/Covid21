<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
             $table->bigInteger('category_id')->unsigned();
             $table->bigInteger('product_id')->unsigned();
         });
        /**
         * this foreign id add suffer's me a lot. 
         * this looks that i have to fear of it.
         * then i find a answer that works in there , the answer is 
         * bigInteger  , saves my day. 
         * 
         */
        Schema::table('category_product' , function (Blueprint $table){
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
