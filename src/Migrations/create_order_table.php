<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('order_sn')->comment('逻辑编号');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->string('order_name', 20)->comment('订单名称');
            $table->unsignedTinyInteger('order_type')->comment('订单类型：1.充值,2.购买商品,3.临时货运,4.长期货运,5.押金保证金,6.专送Pro');
            $table->unsignedInteger('order_item_id')->default(0)->comment('订单详情标识。0.无子项(充值)');
            $table->unsignedDecimal('order_money', 10, 2)->comment('订单总价');
            $table->unsignedDecimal('shipping_money', 10, 2)->default(0)->comment('运费(骑手和司机的费用)');
            $table->unsignedDecimal('pay_money', 10, 2)->comment('实际支付金额');
            $table->unsignedInteger('pay_point')->default(0)->comment('支付积分');
            $table->unsignedInteger('return_point')->default(0)->comment('返点积分');
            $table->unsignedTinyInteger('pay_type')->default(0)->comment('支付方式。0.待定、1.货到付款、2.余额、3.纯积分、4.支付宝、5.微信、6.银联');
            $table->unsignedInteger('order_shipping_id')->default(0)->comment('运输编号。0.无运输需求');
            $table->unsignedInteger('order_invoice_id')->default(0)->comment('开票编号。0.无开票需求');
            $table->string('user_note', 200)->default('')->comment('用户备注');
            $table->tinyInteger('status')->default(1)->comment('订单状态:详见接口文档');
            $table->tinyInteger('property')->default(1)->comment('1.企业订单,2.个人订单,3.其他');
            $table->timestamp('pay_at')->nullable()->comment('支付时间');
            $table->timestamp('expire_at')->nullable()->comment('过期时间');
            $table->timestamp('comment_at')->nullable()->comment('评论时间');
            $table->timestamps();

            $table->unique('order_sn');
        });

        \DB::statement("ALTER TABLE `order` comment '订单主表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
