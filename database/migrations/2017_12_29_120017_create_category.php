<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('category', function(Blueprint $table) {
            
            $table -> increments('id');
            $table -> string('name', 30) -> unique();
            $table -> string('slug') -> unique();
            $table -> string('description') -> nullable(true);
            $table -> string('image') -> nullable(true);
            $table -> integer('order') -> unsigned() -> nullable(true);

            $table -> smallInteger('is_disabled') -> default(10);
            $table -> integer('parent_id') -> unsigned() -> nullable(true);
            
            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by');
            $table -> dateTime('updated_at') -> nullable(true);
            $table -> integer('updated_by') -> nullable(true);
            
        });

        // Schema::table('category', function(Blueprint $table) {
        //     $table -> foreign('parent_id', 'fk-category-parent_id') -> references('id') -> on('category') -> onDelete('cascade');
        // });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //Schema::dropForeign('fk-category-parent_id');
        Schema::dropIfExists('category');
    }
}
