<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->string('github')->nullable();
            $table->string('avatar')->nullable();
            $table->string('job')->nullable();
            $table->string('employment')->nullable();
            $table->string('hometown')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
