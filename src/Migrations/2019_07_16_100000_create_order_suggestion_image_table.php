<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSuggestionImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_suggestion_image', function (Blueprint $table) {
            $table->unsignedInteger('suggestion_id')->comment("订单投诉表id");
            $table->unsignedInteger('image_id')->comment("图片表id");
        });

        DB::statement("ALTER TABLE `order_suggestion_image` comment '订单投诉图片表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_suggestion_image');
    }
}
