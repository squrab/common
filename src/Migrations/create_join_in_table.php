<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_in', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 11);
            $table->string('user_agent');
            $table->ipAddress('ip');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('note')->default('');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `join_in` comment '加入我们活动记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join_in');
    }
}
