<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->string('name', 100)->comment('公司名称');
            $table->unsignedInteger('image_id')->nullable()->comment('logo，关联图片表');
            $table->unsignedInteger('region_id')->comment('所在地区');
            $table->string('address', 100)->default("")->comment('详细地址');
            $table->string('website', 100)->default('')->comment('官网地址');
            $table->text('introduce')->comment('企业介绍');
            $table->timestamps();

            $table->unique('user_id');
        });

        DB::statement("ALTER TABLE `company_info` comment '企业用户信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_info');
    }
}
