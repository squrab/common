<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("order_id")->comment('订单id');
            $table->unsignedInteger('distance')->comment('和上一个地址的距离');
            $table->unsignedInteger('total_distance')->comment('总距离');
            $table->unsignedTinyInteger('sn')->comment('序号，路径顺序');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('城市');
            $table->string('district')->comment('区县');
            $table->string('person')->comment('收件人/发件人');
            $table->string('tel')->comment('收件方式');
            $table->string("name")->default('')->comment('地址名称');
            $table->string("address")->default('')->comment('门牌号');
            $table->string("formatted_address")->default('')->comment('详细地址');
            $table->string('lng')->comment('经度');
            $table->string('lat')->comment('纬度');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_shipping` comment '订单配送信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_shipping');
    }
}
