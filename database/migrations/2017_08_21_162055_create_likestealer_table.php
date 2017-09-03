<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikestealerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likestealer', function (Blueprint $table) {
            $table->bigInteger('FB_user');
            $table->primary('FB_user');
            $table->string('name');
            $table->string('email');
            $table->integer('age_min');
            $table->char('gender', 1);
            $table->tinyInteger('liked');
            $table->string('code');
            $table->tinyInteger('redeemed');
            $table->dateTime('registred_date')->useCurrent();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likestealer');
    }
}
