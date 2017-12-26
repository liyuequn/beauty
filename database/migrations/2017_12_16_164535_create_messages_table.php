<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('send_from_id');//谁发送
            $table->string('send_from_name');//谁发送
            $table->enum('send_from_sys',['omc','qd','erp','other']);//谁发送
            $table->integer('send_to_id');//谁查看
            $table->string('send_to_name');//谁查看
            $table->enum('send_to_sys',['omc','qd','erp','other']);//谁查看
            $table->integer('phone');//手机号
            $table->integer('type');//消息类型
            $table->integer('is_message')->default(0);//是否短信
            $table->integer('is_web')->default(0);//是否网页
            $table->string('content');
            $table->integer('status')->default(0);
            $table->dateTime('read_at')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
