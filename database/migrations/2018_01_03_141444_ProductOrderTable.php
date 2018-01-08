<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_order', function(Blueprint $table) {
            $table -> increments('id');
            $table -> integer('product_id');
            $table -> decimal('discount') -> nullable(true);
            $table -> decimal('service_charge', 8, 2) -> nullable(true);
            $table -> decimal('tax', 8, 2) -> nullable();
            $table -> integer('quantity');
            $table -> decimal('sub_total');
            $table -> decimal('grand_total');
            $table -> smallInteger('status') -> default(10);
            $table -> string('note') -> nullable(true);
            $table -> string('order_by') -> nullable(true);
            
            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by');
            $table -> dateTime('updated_at') -> nullable(true);
            $table -> integer('updated_by') -> nullable(true);

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product_order');
    }
}
