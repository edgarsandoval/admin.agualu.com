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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('member_code')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 15);
            $table->string('cellphone', 15);
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('street');
            $table->string('outdoor_number', 8);
            $table->string('indoor_number', 8)->nullable();
            $table->string('suburb');
            $table->string('postal_code', 8);
            $table->integer('range_id')->unsigned();
            $table->boolean('preferential');
            $table->string('openpay_token')->nullable();
            $table->decimal('budget', 10, 2);
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('status', ['Vigente', 'Calificado', 'Clasificado', 'Activo', 'Inactivo', 'Cancelado']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
