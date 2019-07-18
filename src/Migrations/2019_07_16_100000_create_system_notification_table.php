<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_id')->comment('管理员id');
            $table->string('title')->comment('通知标题');
            $table->unsignedTinyInteger('type')->comment('类型:1.专送Pro小程序、2.专送员APP、3专送ProAPP');
            $table->text('content')->comment('通知类容');
            $table->timestamp('pub_at')->default(now())->comment('发布时间');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `system_notification` comment '系统通知'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_notification');
    }
}
