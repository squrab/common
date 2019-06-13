<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponConstraintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_constraint', function (Blueprint $table) {
            $table->increments('id');
            $table->string('types', 100)->comment('适用范围：1.帮买、 2帮送、 3帮取、`多项以逗号分开`');
            $table->unsignedTinyInteger('usable_users')->comment('可用用户群：coupon_constraint_users的id');
            $table->unsignedTinyInteger('limit_get_period')->comment('限领周期(单位天)：0.不限');
            $table->unsignedTinyInteger('limit_get_num')->comment('限领数量：0.不限');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `coupon_constraint` comment '优惠劵约束表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_constraint');
    }
}
