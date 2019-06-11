<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('coupon_sn')->comment('逻辑编号');
            $table->string('name', 20)->comment('优惠券名称');
            $table->unsignedTinyInteger('coupon_type')->comment('优惠券类型：0.通用、1.帮送、2.帮取、3帮买');
            $table->unsignedInteger('constraint_id')->default(0)->comment('约束编号,0.无约束');
            $table->unsignedTinyInteger('offer_type')->comment('优惠类型：1.满减、2.折扣');
            $table->unsignedDecimal('available_money', 10, 2)->default(0)->comment('满减条件');
            $table->unsignedDecimal('reduce_money', 10, 2)->default(0)->comment('满减金额');
            $table->float('discount', 4, 3)->default(1)->comment('折扣');
            $table->unsignedInteger('total_count')->default(0)->comment('发放总数,0.不限量');
            $table->unsignedInteger('receive_count')->default(0)->comment('已领张数');
            $table->unsignedSmallInteger('expired_day')->default(0)->comment('过期日期,0.无限制');
            $table->timestamp('last_use_at')->comment('最后使用日期');
            $table->text('info')->comment('优惠券说明');
            $table->string('note', 100)->default('')->comment('备注');
            $table->softDeletes();
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `coupon` comment '优惠劵主表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
