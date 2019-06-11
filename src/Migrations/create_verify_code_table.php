<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('account_type')->comment('账号类型：1.手机号、2.邮箱');
            $table->string('account', 40)->comment('账号：手机号、邮箱等');
            $table->string('code_type', 40)->comment('短信类型');
            $table->char('code', 6)->comment('验证码');
            $table->tinyInteger('status')->default(0)->comment('状态：0.待使用、1.已使用');
            $table->timestamp('expired_at')->comment('过期时间');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `verify_code` comment '验证码表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verify_code');
    }
}
