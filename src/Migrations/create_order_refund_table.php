<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRefundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refund', function (Blueprint $table) {
            $table->increments('id');
            $table->string('remark')->default('')->comment('退款备注');
            $table->string('out_refund_no')->default('')->comment('第三方退款单号');
            $table->string('refund_sn')->default('')->comment('系统退款单号');
            $table->unsignedInteger('order_id')->comment('关联订单');
            $table->unsignedInteger('user_id')->comment('退款申请人');
            $table->tinyInteger('status')->default(1)->comment('退款状态');
            $table->tinyInteger('type')->comment('退款类型/ 与订单支付类型一致');
            $table->decimal('money')->comment('退款金额');
            $table->timestamp("refund_at")->nullable()->comment("退款回调时间");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_refund` comment '订单退款表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_refund');
    }
}
