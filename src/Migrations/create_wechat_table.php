<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat', function (Blueprint $table) {
            $table->increments('id');
            $table->string("open_id")->comment("openid");
            $table->string("user_id")->default(0)->comment("关联的用户");
            $table->unsignedTinyInteger("type")->comment("1.货运,2.专送");
            $table->string("union_id")->nullable()->comment("unionid");
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `wechat` comment '用户微信信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat');
    }
}
