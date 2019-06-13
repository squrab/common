<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('所属用户');
            $table->string("contact_name")->comment('联系人姓名');
            $table->string("contact_mobile")->comment('联系人手机号');
            $table->unsignedTinyInteger("type")->comment('1：发件地址；2：收件地址');
            $table->string("name")->default('')->comment('地址名称');
            $table->string("address")->default('')->comment('门牌号');
            $table->string("formatted_address")->default('')->comment('详细地址');
            $table->string("province")->comment('省');
            $table->string("city")->comment('市');
            $table->string("district")->comment('区');
            $table->string("lng")->comment('经度');
            $table->string("lat")->comment('纬度');
            $table->unsignedTinyInteger('asterisk')->default(0)->comment('是否置顶');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_address` comment '用户地址表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}
