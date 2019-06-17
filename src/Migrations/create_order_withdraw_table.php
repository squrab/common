<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_withdraw', function (Blueprint $table) {
            $table->increments('id');
            $table->string('remark')->default('')->comment('提现备注');
            $table->string('out_withdraw_no')->default('')->comment('第三方提现单号');
            $table->string('withdraw_sn')->default('')->comment('系统提现单号');
            $table->string('account')->comment('提现账号');
            $table->unsignedInteger('user_id')->comment('提现申请人');
            $table->tinyInteger('status')->default(1)->comment('提现状态 1 提现中 2 提现完成 3 提现失败');
            $table->tinyInteger('type')->comment('提现类型:1.支付宝、2.银行卡、3.微信');
            $table->unsignedInteger('flag')->default(1)->comment('种类: 1.提现,2绑卡');
            $table->decimal('apply_money')->comment('申请提现金额');
            $table->decimal('real_money')->default(0)->comment('实际提现金额');
            $table->decimal('charge')->default(0)->comment('提现手续费');
            $table->timestamp("withdraw_at")->nullable()->comment("提现时间");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_withdraw` comment '提现记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_withdraw');
    }
}
