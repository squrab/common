<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTradeNoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_trade_no', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单主表');
            $table->unsignedBigInteger('trade_no')->comment('下单编号');
            $table->string('out_trade_no', 50)->default('')->comment('第三方支付订单号');
            $table->tinyInteger('is_pay')->default(0)->comment('是否支付');
            $table->timestamps();

            $table->unique('trade_no');
        });

        DB::statement("ALTER TABLE `order_trade_no` comment '订单第三方支付订单号表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_trade_no');
    }
}
