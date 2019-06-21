<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressOrderReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_order_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 50)->default('')->comment('预约时间可读名称');
            $table->timestamp('reservation_at')->comment('预约时间');
            $table->timestamp('push_at')->comment('推送时间');
            $table->unsignedTinyInteger('push_status')->default(0)->comment('是否已推送');
            $table->text('push_user')->nullable()->comment('已推送专送员id');
        });

        DB::statement("ALTER TABLE `express_order_reservation` comment '专送Pro订单预约表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_order_reservation');
    }
}
