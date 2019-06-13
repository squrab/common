<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->string('nickname', 20)->default('')->comment('昵称');
            $table->unsignedInteger('image_id')->nullable()->comment('头像，关联图标表');
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别：0.未知、1.男、2.女');
            $table->string('sign', 40)->default('')->comment('个性签名');
            $table->timestamp('birthday')->nullable()->comment('出生日期');
            $table->timestamps();

            $table->unique('user_id');
        });

        DB::statement("ALTER TABLE `personal_info` comment '普通用户信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_info');
    }
}
