<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemNotificationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_notification_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('system_notification_id')->comment('系统通知id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `system_notification_status` comment '系统通知用户读取状态'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_notification_status');
    }
}
