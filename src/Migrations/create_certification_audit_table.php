<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->unsignedInteger('admin_id')->default(0)->comment('管理员标识');
            $table->unsignedInteger('target_id')->comment('关联编号');
            $table->unsignedTinyInteger('type')->comment('认证类型：1.实名认证、2.司机认证、3.企业认证、4.汽车认证、5.专送员认证');
            $table->tinyInteger('status')->default(0)->comment('审核状态：-1.未通过、0.审核中、1.审核通过');
            $table->string('note', 100)->default('')->comment('备注');
            $table->string('description', 100)->default('')->comment('未通过说明');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `certification_audit` comment '认证审核表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certification_audit');
    }
}
