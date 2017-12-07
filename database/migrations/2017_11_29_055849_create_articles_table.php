<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('author_id')->default(0);
            $table->string('title')->default(' ');
            $table->text('content')->default(' ');
            $table->tinyInteger('type')->default(0);
            $table->dateTime('post_at')->comment('发表时间')->default(CURRENT_TIMESTAMP);
            $table->dateTime('last_comment_at')->comment('评论时间')->default(CURRENT_TIMESTAMP);
            $table->tinyInteger('post_status')->comment('发表状态')->default(0);
            $table->integer('hits')->comment('点击数')->default(0);
            $table->tinyInteger('isTop')->comment('是否置顶')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
