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
            $table->integer('issue_num')->comment('发放数量');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('admin_id')->nullable()->comment('发放人');
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