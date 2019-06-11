<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelfServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('self_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->comment('问题类型');
            $table->integer('cluster_id')->unsigned()->comment('1、用户APP。2、企业PC。3、司机APP。4、骑手APP');
            $table->string('issue')->comment('问题');
            $table->text('answer')->comment('回答');
            $table->softDeletes();
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `self_service` comment '自助服务类容表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('self_service');
    }
}
