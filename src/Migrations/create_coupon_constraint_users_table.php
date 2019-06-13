<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponConstraintUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_constraint_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('可读名称');
            $table->text('sql')->comment('用户群原始SQL语句');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `coupon_constraint_users` comment '优惠劵可用用户群'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_constraint_users');
    }
}
