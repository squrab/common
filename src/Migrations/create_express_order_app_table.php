<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressOrderAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_order_app', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('express_order_id')->comment('专送订单编号');
            $table->unsignedInteger('order_id')->comment('专送订单编号');
            $table->unsignedInteger('user_id')->comment('骑手身份标识');
            $table->smallInteger('status')->default(1)->comment('订单状态：详见接口文档');
            $table->string('user_note', 200)->comment('用户取消备注');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `express_order_app` comment '专送Pro订单骑手状态记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_order_app');
    }
}
