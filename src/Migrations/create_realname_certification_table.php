<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealnameCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realname_certification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('身份标识');
            $table->string('realname', 20)->comment('真实姓名');
            $table->string('id_card', 18)->comment('身份证编号');
            $table->unsignedInteger('certification1_image_id')->comment('身份证正面');
            $table->unsignedInteger('certification2_image_id')->comment('身份证反面');
            $table->unsignedInteger('certification3_image_id')->comment('身份证手持');
            $table->timestamps();

            $table->unique('user_id');
        });

        DB::statement("ALTER TABLE `realname_certification` comment '实名认证表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realname_certification');
    }
}
