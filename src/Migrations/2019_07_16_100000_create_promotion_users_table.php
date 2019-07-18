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
        Schema::create('promotion_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('可读名称');
            $table->string('name', 50)->comment('唯一名称');
            $table->text('sql')->nullable()->comment('用户群SQL语句');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `promotion_users` comment '活动使用人群'");
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