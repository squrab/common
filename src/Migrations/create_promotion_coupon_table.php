<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coupon_id')->comment('优惠劵id');
            $table->unsignedInteger('promotion_id')->comment('优惠活动id');
            $table->timestamps();

            $table->unique(
                ['coupon_id', 'promotion_id'],
                'promotion_coupon_unique'
            );
        });

        DB::statement("ALTER TABLE `promotion_coupon` comment '活动优惠劵关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_coupon');
    }
}
