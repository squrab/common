<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressPullNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_pull_new', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('分享用户id');
            $table->text('passivity_user_id')->nullable()->comment('被分享用户id集合');
            $table->string('random_str', 32)->comment('用户唯一分享码');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `express_pull_new` comment '骑手拉新活动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_pull_new');
    }
}
