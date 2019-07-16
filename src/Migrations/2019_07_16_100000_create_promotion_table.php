<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('活动名称');
            $table->date('start_date')->comment('开始日期');
            $table->date('end_date')->comment('结束日期');
            $table->unsignedInteger('banner_id')->comment('图片表id,配图');
            $table->unsignedInteger('admin_id')->comment('创建人');
            $table->tinyInteger('status')->default(1)->comment('是否上线,双重限制,优先考虑此字段.上线状态下在根据时间判断');
            $table->string('info')->default('')->comment('活动规则');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `promotion` comment '优惠活动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion');
    }
}
