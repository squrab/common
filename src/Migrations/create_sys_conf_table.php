<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysConfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_conf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_key', 40)->comment('配置键');
            $table->string('c_value')->comment('配置值');
            $table->string('note', 100)->default('')->comment('备注');
            $table->timestamps();

            $table->unique('c_key');
        });

        \DB::statement("ALTER TABLE `sys_conf` comment '系统逻辑参数表'");

        DB::table("sys_conf")->insert([
            "c_key"=>"starting_mileage",
            "c_value"=>"5000",
            "note"=>"起步里程，单位米",
        ]);
        DB::table("sys_conf")->insert([
            "c_key"=>"sms_expire_time",
            "c_value"=>"5",
            "note"=>"验证码过期时间，单位分钟",
        ]);
        DB::table("sys_conf")->insert([
            "c_key"=>"withdraw_arrive_time",
            "c_value"=>"2",
            "note"=>"提现到账时间，单位天",
        ]);
        DB::table("sys_conf")->insert([
            "c_key"=>"order_comment_time",
            "c_value"=>"2",
            "note"=>"订单可评论时间，单位天",
        ]);
        DB::table("sys_conf")->insert([
            "c_key"=>"order_expire_time",
            "c_value"=>"10",
            "note"=>"订单过期时间，单位分钟",
        ]);
        DB::table("sys_conf")->insert([
            "c_key"=>"hotline",
            "c_value"=>"4008-588-855",
            "note"=>"客服电话",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_conf');
    }
}
