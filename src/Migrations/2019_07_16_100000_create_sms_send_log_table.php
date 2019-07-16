<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSendLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_send_log', function (Blueprint $table) {
            $table->increments('id');
            $table->char('phone', 11)->comment('短信类型');
            $table->string('sms_type', 40)->default('')->comment('短信类型');
            $table->string('gateway', 40)->default('')->comment('短信类型');
            $table->tinyInteger('status')->comment('发送状态：-1，失败、1.成功');
            $table->text('result')->comment('发送结果信息');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `sms_send_log` comment '短信发送记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_send_log');
    }
}
