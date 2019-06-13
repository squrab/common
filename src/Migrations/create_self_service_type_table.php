<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelfServiceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('self_service_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('describe')->comment('描述');
            $table->string('icon', 20)->nullable()->comment('图标名称');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `self_service_type` comment '自助服务类型表'");

        DB::table('self_service_type')->insert(
            [
                [
                    'title' => '常见问题',
                    'describe' => '日常使用中易碰到的问题',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => '订单类问题',
                    'describe' => '用户在整个订单流程中出现的相关问题',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => '配送类问题',
                    'describe' => '配送过程中容易出现的相关问题',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => '账户类问题',
                    'describe' => '用户在使用过程中产生的与账户相关的问题',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
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
        Schema::dropIfExists('self_service_type');
    }
}
