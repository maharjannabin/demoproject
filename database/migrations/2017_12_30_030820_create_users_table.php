<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('username', 30) -> nullable(false);
            $table -> string('password');
            $table -> string('first_name', 30) -> nullable(true);
            $table -> string('middle_name', 30) -> nullable(true);
            $table -> string('last_name', 30) -> nullable(true);
            $table -> string('email', 50) -> nullable(true);
            $table -> string('phone', 20) -> nullable(true);
            

            $table -> smallInteger('gender') -> default(10);
            $table -> smallInteger('status') -> default(10);
            $table -> smallInteger('is_disabled') -> default(10);
            $table -> integer('role') -> nullable(false);;

            $table->rememberToken();

            $table -> dateTime('created_at') -> useCurrent();
            $table -> integer('created_by') -> nullable(false);
            $table -> dateTime('updated_at') -> nullable(true);
            $table -> integer('updated_by') -> nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
