<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("tag_id")->comment("tag表自增ID");;
            $table->integer("lesson_id")->comment("lesson表自增ID");
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
        Schema::dropIfExists('tag_lessons');
    }
}
