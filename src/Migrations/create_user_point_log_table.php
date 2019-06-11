<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_point_log', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->unsignedTinyInteger('target_type')->default(1)
                ->comment('记录来源:0.清零、1.注册、2.登录、3.邀请、4.被邀请、5.签到、6.其它活动、7.购物、8.消费');
            $table->unsignedBigInteger('target_id')->comment('相关单据编号');
            $table->integer('amount')->comment('变动金额');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `user_point_log` comment '用户积分记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_point_log');
    }
}
