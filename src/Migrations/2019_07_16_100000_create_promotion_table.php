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
            $table->string('promotion_sn', 50)->comment('逻辑编号');
            $table->string('name', 50)->comment('活动名称');
            $table->unsignedTinyInteger('type')->comment('活动入口:1.首页弹窗、2.banner跳转、3.下单分享、4.无');
            $table->unsignedInteger('admin_id')->comment('创建人');
            $table->string('info')->default('')->comment('活动规则');
            $table->text('usable_sql')->comment('可使用人群SQL,来源于promotion_users表');
            $table->timestamp('start_at')->comment('开始时间');
            $table->timestamp('end_at')->comment('结束时间');
            $table->unsignedTinyInteger('method')->default(1)->comment('领取方式:1.被动领取、2.主动领取');
            $table->unsignedTinyInteger('limit_get')->default(0)->comment('分享类型每天限领.其他类型为0.');
            $table->tinyInteger('status')->default(1)->comment('是否上线,双重限制,优先考虑此字段.上线状态下在根据时间判断');
            $table->string('src')->nullable()->comment('跳转地址');
            $table->unsignedInteger('banner_id')->nullable()->comment('图片表id,配图');
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
