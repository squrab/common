<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_coupon_issue', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('优惠劵id');
            $table->unsignedInteger('coupon_id')->comment('优惠劵id');
            $table->unsignedInteger('promotion_id')->comment('优惠劵id');
            $table->unsignedInteger('issue_num')->default(1)->comment('发放数量');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `promotion_coupon_issue` comment '活动的优惠劵发放记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_coupon_issue');
    }
}
