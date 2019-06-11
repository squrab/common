<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("order_id")->comment("订单id");
            $table->char("code", 6)->comment("取件码/收件吗");
            $table->tinyInteger('type')->default(1)->comment("1 取件码 2收件码");
            $table->tinyInteger('status')->default(1)->comment("1未使用2已使用");
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `order_code` comment '订单验证码表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_code');
    }
}
