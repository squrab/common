<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSuggestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_suggestion', function (Blueprint $table) {
            $table->increments('id');
            $table->text("content")->comment("投诉内容");
            $table->unsignedInteger("order_id")->comment("订单id");
            $table->unsignedInteger("driver_id")->comment("关联的司机");
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `order_suggestion` comment '订单投诉表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_suggestion');
    }
}
