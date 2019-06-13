<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderConfirmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_confirm', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('driver_id')->comment('司机/专送员id');
            $table->unsignedInteger('image_id')->comment('图片id');
            $table->tinyInteger("type")->comment("确认类型（1是开始前确认：2是结束确认）");
        });

        DB::statement("ALTER TABLE `order_confirm` comment '订单确认图片表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_confirm');
    }
}
