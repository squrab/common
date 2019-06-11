<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionOpenedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_opened', function (Blueprint $table) {
            $table->integer('region_id')->unique()->unsigned()->comment('城市表id');
            $table->string('city', 50)->unique()->comment('城市名称');
            $table->timestamps();

            $table->primary('region_id');
        });

        \DB::statement("ALTER TABLE `region_opened` comment '开放城市表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_opened');
    }
}
