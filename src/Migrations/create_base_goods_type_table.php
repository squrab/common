<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseGoodsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_goods_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->comment('类型名称');
            $table->integer('sort')->default(100)->comment('排序');
            $table->unsignedInteger('parent_id')->default(0)->comment('父id,顶级为0');
            $table->tinyInteger('type')->default(0)->comment('1.货运、2.专送');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `base_goods_type` comment '配送类型表'");

        DB::table('base_goods_type')->insert([
            [
                'text' => '其他',
                'sort' => 100,
                'parent_id' => 0,
                'type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'text' => '其他',
                'sort' => 100,
                'parent_id' => 0,
                'type' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_goods_type');
    }
}
