<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 交押金
         * 退押金
         * 扣押金
         * 补足押金
         * 判断押金是否充足
         * 是否交了押金
         */
        Schema::create('driver_deposit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("driver_id")->comment("司机/专送员id");
            $table->unsignedDecimal("before_money")->comment("操作之前的金额");
            $table->unsignedDecimal("after_money")->comment("操作之后的金额");
            $table->decimal("change_money")->comment("此次操作金额");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_deposit` comment '押金记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_deposit');
    }
}
