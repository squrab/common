<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverHandleLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_handle_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->comment('专送员id');
            $table->unsignedInteger('admin_id')->comment('管理员id');
            $table->string('info')->comment('操作信息');
            $table->string('note')->default('')->comment('操作备注');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_handle_log` comment '专送员操作记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_handle_log');
    }
}
