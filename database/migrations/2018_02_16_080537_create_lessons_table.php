<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->comment("视频标题");
            $table->string("introduce")->comment("视频简介");
            $table->string("preview")->comment("视频图片预览");
            $table->tinyInteger("iscommend")->comment("是否为推荐");
            $table->tinyInteger("ishot")->comment("是否为热门");
            $table->integer("click")->comment("点击数");
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
        Schema::dropIfExists('lessons');
    }
}
