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
        Schema::create('coupon_issue', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coupon_id')->comment('优惠劵id');
            $table->unsignedTinyInteger('type')->comment('发放对象：1.活动、2.个人');
            $table->integer('issue_num')->comment('发放数量');
            $table->unsignedInteger('target_id')->comment('目标id,活动id或用户id');
            $table->unsignedInteger('admin_id')->comment('发放人');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `coupon_issue` comment '优惠劵发放记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_issue');
    }
}
