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
            $table->integer('author_id');
            $table->string('title');
            $table->text('content');
            $table->tinyInteger('type');
            $table->dateTime('post_at')->comment('发表时间');
            $table->dateTime('last_comment_at')->comment('评论时间')->nullable();
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
