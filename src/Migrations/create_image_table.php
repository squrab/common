<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic_path', 100)->comment('大图地址');
            $table->string('small_path', 100)->comment('小图地址');
            $table->unsignedTinyInteger('path_type')->default(2)->comment('图片url类型：1.完整链接、2.来自七牛云公有、3.来自七牛云私有');
            $table->string('note', 100)->default('')->comment('备注');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `image` comment '图片表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image');
    }
}
