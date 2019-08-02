<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverDoubleSeventhActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_double_seventh_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('专送员id');
            $table->unsignedTinyInteger('type')->comment('类型:1.帮买、2.帮送|帮取');
            $table->string('order_id')->comment('订单id集合,逗号分隔id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_double_seventh_activity` comment '专送员七夕活动'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_double_seventh_activity');
    }
}
