<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->comment('名称');
            $table->string('password')->comment('密码');
            $table->string('name')->default('')->comment('手机号码');
            $table->string('note')->default('')->comment('备注');
            $table->text('login_token_sign')->nullable()->comment('最后登录的token');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `admin` comment '后台管理用户表'");

        DB::table('admin')->insertGetId([
            'id' => 1,
            'username' => 'admin',
            'password' => bcrypt('41177164'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
