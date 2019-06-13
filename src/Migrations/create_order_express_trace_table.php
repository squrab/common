<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderExpressTraceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_express_trace', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("order_id")->comment("订单id");
            $table->unsignedInteger("express_order_app_id")->comment("骑手接单表id");
            $table->tinyInteger("status")->comment("变更后的状态");
            $table->timestamp("at")->comment("发生时间");
            $table->string("lat")->nullable()->comment("纬度");
            $table->string("lng")->nullable()->comment("经度");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_express_trace` comment '专送Pro订单骑手操作位置记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_express_trace');
    }
}
