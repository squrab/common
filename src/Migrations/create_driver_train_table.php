<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverTrainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_train', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("driver_id")->comment("司机/专送员id");
            $table->tinyInteger("status")->comment("培训状态(1:通过；2：未通过；3：未培训)");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `driver_train` comment '培训记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_train');
    }
}
