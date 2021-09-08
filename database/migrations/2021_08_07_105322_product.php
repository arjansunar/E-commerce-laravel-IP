<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('stock');
            $table->unsignedInteger('price');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->string('image_url');
            $table->foreign('category_id')->references('id')->on('category')->delete('cascade');
        });

        DB::statement(
            "ALTER TABLE product ADD FOREIGN KEY (sub_category_id) REFERENCES sub_category(id) ON DELETE CASCADE"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
