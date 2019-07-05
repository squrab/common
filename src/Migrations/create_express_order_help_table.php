<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressOrderHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_order_help', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 50)->comment('标签');
            $table->unsignedInteger('image_id')->comment('banner或icon,image表id');
            $table->unsignedTinyInteger('type')->comment('类型: 1.特定H5类型、2.速购类型、');
            $table->unsignedTinyInteger('sort')->default(1)->comment('排序,越大越靠前');
            $table->string('link')->default('')->comment('跳转地址');
            $table->unsignedTinyInteger('status')->default(1)->comment('是否开启');
            $table->text('note')->nullable()->comment('备注或说明');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `express_order_help` comment '帮买订单内容表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_order_help');
    }
}
