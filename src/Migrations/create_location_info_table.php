<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location', 50)->comment('经纬度组合:lng,lat');
            $table->unsignedInteger('adcode')->comment('行政区编码');
            $table->string('township', 100)->comment('社区街道名称');
            $table->string('neighborhood_name', 100)->comment('社区名称');
            $table->string('building_name', 100)->comment('建筑名称');
            $table->string('formatted_address', 100)->comment('结构化详细地址');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `location_info` comment '位置信息缓存表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_info');
    }
}
