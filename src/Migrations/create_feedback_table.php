<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->unsignedTinyInteger('type_id')->comment('类型标识');
            $table->string('content')->comment('反馈内容');
            $table->string('note', 100)->default('')->comment('备注');
            $table->tinyInteger('status')->default(0)->comment('处理状态：-1.垃圾信息、0.待处理、1.已处理');
            $table->timestamps();

            $table->index('user_id');
        });

        \DB::statement("ALTER TABLE `feedback` comment '用户反馈信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
