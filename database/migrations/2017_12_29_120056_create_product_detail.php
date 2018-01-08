<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_detail', function(Blueprint $table) {
            $table -> increments('id');
            $table -> integer('size_id') -> unsigned();
            $table -> integer('product_id') -> unsigned();
            $table -> integer('quantity');

            $table -> decimal('price', 15, 2);
            $table -> string('description');
            $table -> smallInteger('is_disabled') -> default(10);
            $table -> integer('order');

        
            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by');
            $table -> dateTime('updated_at') -> nullable(true);
            $table -> integer('updated_by') -> nullable(true);
            
            $table->unique(['product_id', 'size_id']);
        });

        Schema::table('product_detail', function(Blueprint $table) {
            $table -> foreign('product_id', 'fk-product_detail-product_id') -> references('id') -> on('product') -> onDelete('cascade');
            $table -> foreign('size_id', 'fk-product_detail-size_id') -> references('id') -> on('product_size') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropForeign('fk-product_detail-product_id');
        Schema::dropForeign('fk-product_detail-size_id');
        Schema::dropIfExists('product_detail');
    }
}
