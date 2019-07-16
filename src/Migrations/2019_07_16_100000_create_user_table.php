<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->char('phone', 11)->comment('手机号');
            $table->string('email', 40)->nullable()->comment('邮箱');
            $table->string('wechat', 40)->nullable()->comment('微信');
            $table->unsignedInteger("custom_id")->default('0')->comment("");
            $table->string('password')->default('')->comment('登录密码');
            $table->string('pay_password')->default('')->comment('支付密码');
            $table->unsignedTinyInteger('user_type')->default(1)->comment('用户类型：1.普通用户、2.特约商户、3.企业用户，4.专送员');
            $table->unsignedTinyInteger('user_level')->default(1)->comment('会员等级：1.普通、2.白银、3.黄金、4.钻石');
            $table->unsignedDecimal('money')->default(0)->comment('用户账户可用金额');
            $table->unsignedDecimal('money_frozen')->default(0)->comment('用户账户不可用金额');
            $table->unsignedInteger("point")->default('0')->comment("积分");
            $table->tinyInteger('status')->default(0)->comment('账号状态。-1.禁用、0.待认证、1、正常、2.实名认证、');
            $table->string('note', 100)->default('')->comment('备注');
            $table->text('login_token_sign')->nullable()->comment('最后登录的token');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user` comment '用户主表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
