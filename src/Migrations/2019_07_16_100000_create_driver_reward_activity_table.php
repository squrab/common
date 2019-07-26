<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverRewardActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_reward_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('专送员id');
            $table->date('date')->comment('日期');
            $table->string('order_id')->comment('订单id集合,逗号分隔id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_reward_activity` comment '专送员活跃奖励活动'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_reward_activity');
    }
}
