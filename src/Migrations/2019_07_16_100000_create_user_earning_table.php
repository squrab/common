<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEarningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_earning', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('收益订单id');
            $table->unsignedInteger('user_id')->comment('收益用户id');
            $table->unsignedDecimal('money')->comment('金额');
            $table->timestamp('acquisition_at')->comment('获得时间');
            $table->timestamp('person_at')->nullable()->comment('审核时间');
            $table->timestamp('collected_at')->nullable()->comment('到账时间');
        });

        DB::statement("ALTER TABLE `user_earning` comment '司机/骑手收益表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_earning');
    }
}
