<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('分类名称');
            $table->unsignedTinyInteger('type')->comment('适用用户类型：0.通用、1.普通用户、2.司机、3.公司、');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `feedback_type` comment '用户反馈类型表'");

        DB::table('feedback_type')->insert(
            [
                [
                    'title' => 'PC使用',
                    'type' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'App使用',
                    'type' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => '小程序使用',
                    'type' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => '其他建议',
                    'type' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_type');
    }
}
