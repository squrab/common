<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverDepositAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_deposit_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('driver_id')->comment('骑手/司机id');
            $table->unsignedInteger('user_withdraw_id')->comment('骑手/司机提现账号id');
            $table->unsignedInteger('order_withdraw_id')->comment('提现记录表id');
            $table->unsignedTinyInteger('status')->default(0)->comment('提现状态,0.未处理、1.已处理');
            $table->string('remark')->default('')->comment('审核备注');
            $table->unsignedInteger('admin_id')->nullable()->default(null)->comment('审核人id');
            $table->timestamp('arrival_at')->nullable()->comment('到账时间');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_deposit_audit` comment '押金提现审核表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_deposit_audit');
    }
}
