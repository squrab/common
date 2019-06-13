<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->comment('上级地区编号');
            $table->string('name', 40)->comment('地区名称');
            $table->string('pinyin')->comment('拼音');
            $table->string('lon', 20)->comment('经度');
            $table->string('lat', 20)->comment('纬度');
            $table->unsignedTinyInteger('level')->default(0)->comment('地区级别：0.国家、1.省份、2.城市、3.区县');
        });

        DB::statement("ALTER TABLE `region` comment '省市区信息三级联动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region');
    }
}
