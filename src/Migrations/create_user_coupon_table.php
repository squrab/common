<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户编号');
            $table->unsignedInteger('coupon_id')->comment('优惠券编号');
            $table->unsignedInteger('promotion_id')->nullable()->comment('活动id,无指定活动为null');
            $table->unsignedInteger('order_id')->nullable()->comment('订单编号');
            $table->timestamp('use_at')->nullable()->comment('使用时间');
            $table->timestamp('expired_at')->nullable()->comment('过期时间');
            $table->timestamps();

            $table->index('user_id');
        });

        DB::statement("ALTER TABLE `user_coupon` comment '用户优惠劵表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_coupon');
    }
}
