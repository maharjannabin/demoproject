<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('product', function(Blueprint $table) {
            $table -> increments('id');
            $table -> string('name') -> unique();
            $table -> string('slug') -> unique();
            $table -> integer('category_id') -> unsigned();
            $table -> string('description') -> nullable(true);
            
            $table -> smallInteger('status') -> default(10);
            $table -> smallInteger('is_disabled') -> default(10);
            $table -> decimal('weight', 8, 2) -> nullable(true);
            $table -> integer('brand_id') -> nullable(true) -> unsigned();
            $table -> integer('order') -> unsigned() -> nullable(true);

            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by');
            $table -> dateTime('updated_at') -> nullable(true);
            $table -> integer('updated_by') -> nullable(true);
            
            
        });

        Schema::table('product', function(Blueprint $table) { 
            $table -> foreign('category_id', 'fk-product-category_id') -> references('id') -> on('category') -> onDelete('cascade');    
            //$table -> foreign('brand_id', 'fk-product-brand_id') -> references('id') -> on('product_brand') -> onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropForeign('fk-product-category_id');
        //Schema::dropForeign('fk-product-brand_id');
        Schema::dropIfExists('product');
    }
}
