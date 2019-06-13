<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBalanceLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance_log', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->unsignedTinyInteger('target_type')->default(1)
                ->comment('记录来源:1.订单（包括充值和消费）、2.骑手培训奖励、3.骑手跑单奖励、4.退款、');
            $table->unsignedBigInteger('target_id')->comment('相关单据编号');
            $table->decimal('amount', 10, 2)->comment('变动金额');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_balance_log` comment '用户余额记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_balance_log');
    }
}
