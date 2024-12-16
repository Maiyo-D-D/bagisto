<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('type');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('attribute_family_id')->unsigned()->nullable();
            $table->json('additional')->nullable();
            $table->timestamps();

            $table->foreign('attribute_family_id')->references('id')->on('attribute_families')->onDelete('NO ACTION');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('NO ACTION');
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('NO ACTION');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('NO ACTION');
        });

        Schema::create('product_relations', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('parent_id')->references('id')->on('products')->onDelete('NO ACTION');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('NO ACTION');
        });

        Schema::create('product_super_attributes', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('NO ACTION');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('NO ACTION');
        });

        Schema::create('product_up_sells', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('parent_id')->references('id')->on('products')->onDelete('NO ACTION');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('NO ACTION');
        });

        Schema::create('product_cross_sells', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('parent_id')->references('id')->on('products')->onDelete('NO ACTION');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cross_sells');

        Schema::dropIfExists('product_up_sells');

        Schema::dropIfExists('product_super_attributes');

        Schema::dropIfExists('product_relations');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('products');
    }
};
