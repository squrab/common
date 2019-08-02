<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessDevelopmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_development', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn', 20)->comment('BD编号');
            $table->string('name', 20)->comment('姓名');
            $table->string('phone', 20)->comment('手机号码');
            $table->string('province', 20)->comment('省编码');
            $table->string('city', 20)->comment('市编码');
            $table->string('district', 20)->comment('区编码');
            $table->text('note')->nullable()->comment('备注');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `business_development` comment '商务拓展表'");

        Schema::create('business_development_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bd_id')->comment('商务拓展表id');
            $table->unsignedInteger('user_id')->comment('用户表id');
            $table->tinyInteger('status')->default(1)->comment('状态: -1.失效、 1.正常');
            $table->unsignedTinyInteger('is_first_bind')->default(1)->comment('是否首次绑定');
            $table->unsignedInteger('image_id')->nullable()->comment('商户签约PDF,图片表id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `business_development_user` comment '商务拓展关联用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_development');
        Schema::dropIfExists('business_development_user');
    }
}
