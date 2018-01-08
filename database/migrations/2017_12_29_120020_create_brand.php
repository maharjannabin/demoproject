<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('product_brand', function(Blueprint $table) {
            $table -> increments('id');
            $table -> string('name', 100) -> unique();
            $table -> string('slug') -> unique();
            $table -> string('description') -> nullable(true);
            $table -> string('logo') -> nullable(true);
            $table -> smallInteger('is_disabled') -> default(10);
            $table -> integer('order') -> unsigned() -> nullable(true);

            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by');
            $table -> dateTime('updated_at') ->  nullable(true);            
            $table -> integer('updated_by') ->  nullable(true);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     
    }
}
