<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('personal_user_id')->comment('货主身份标识');
            $table->unsignedInteger('driver_user_id')->nullable()->comment('骑手身份标识');
            $table->string('start_coordinate', 40)->comment('起始坐标，以,分割');
            $table->string('end_coordinate', 40)->comment('终点坐标，以,分割');
            $table->unsignedInteger('distance')->comment('行程长度，单位/米');
            $table->unsignedDecimal('start_price', 10, 2)->comment('起始价');
            $table->unsignedDecimal('mileage_price', 10, 2)->comment('里程价');
            $table->unsignedDecimal('total_money', 10, 2)->comment('总价');
            $table->unsignedDecimal('driver_money', 10, 2)->default(0)->comment('骑手费用');
            $table->tinyInteger('status')->default(0)->comment('订单状态：');
            $table->unsignedtinyInteger("type")->comment('跑腿单类型：1.帮送、 2帮买、 3帮取、');
            $table->unsignedtinyInteger("kind")->default(1)->comment('订单类型：1.实时单、2.预约单、');
            $table->string("description")->default("")->comment('描述');
            $table->string("remark")->default("")->comment('备注/其他需求');
            $table->unsignedTinyInteger('need_code')->default(1)->comment('是否需要取收件码');
            $table->unsignedInteger('weight')->comment("单位公斤");
            $table->unsignedDecimal('bridge_fee')->default(0)->comment("过桥费");
            $table->unsignedDecimal('tip')->default(0)->comment("小费");
            $table->unsignedDecimal('insurance_fee')->default(0)->comment("货损险/保险费");
            $table->unsignedDecimal('night_fee')->default(0)->comment("夜间溢价");
            $table->string("goods_type")->default("")->comment("货物类型");
            $table->timestamp('complete_at')->nullable()->comment('完成时间');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `express_order` comment '专送Pro订单副表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_order');
    }
}
