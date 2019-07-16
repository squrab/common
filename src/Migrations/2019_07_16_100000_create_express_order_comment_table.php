<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressOrderCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_order_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_order_id')->comment('专送Pro订单副表标识');
            $table->unsignedInteger('order_id')->comment('订单主表标识');
            $table->unsignedInteger('driver_id')->comment('骑手id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedTinyInteger('score')->default(5)->comment('评价得分');
            $table->unsignedTinyInteger('type')->default(1)->comment('类型');
            $table->string('content', 200)->default('')->comment('评价内容');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `express_order_comment` comment '专送Pro订单评论表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_order_comment');
    }
}
