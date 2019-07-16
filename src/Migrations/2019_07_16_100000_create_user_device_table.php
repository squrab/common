<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('platform_id')->comment('平台唯一标识;比如是极光的register_id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedTinyInteger('platform')->comment('平台；如极光，个推等');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_device` comment '用户第三方推送识别号记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_device');
    }
}
