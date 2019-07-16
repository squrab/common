<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverRealTimeLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_real_time_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->comment('骑手id');
            $table->string('lat', 50)->comment('经度');
            $table->string('lng', 50)->comment('纬度');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_real_time_location` comment '骑手位置信息'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_real_time_location');
    }
}
