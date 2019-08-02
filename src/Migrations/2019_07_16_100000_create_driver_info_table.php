<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户标识');
            $table->unsignedInteger('region_id')->comment('运营城市，关联地区表');
            $table->unsignedTinyInteger('evaluation_score')->default(100)->comment('信用分');
            $table->unsignedTinyInteger('type')->default(100)->comment('1.专职、 2. 兼职');
            $table->unsignedInteger('comment_num')->default(0)->comment('评分人数');
            $table->timestamp('blacklist_at')->nullable()->comment('拉黑限制时间');
            $table->timestamps();

            $table->unique('user_id');
        });

        DB::statement("ALTER TABLE `driver_info` comment '专送员信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_info');
    }
}
