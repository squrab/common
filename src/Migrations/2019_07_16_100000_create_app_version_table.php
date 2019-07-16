<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_version', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version_code', 20)->comment('版本号，如：2018010110');
            $table->string('version_name', 20)->comment('版本名，如：v1.0.0');
            $table->unsignedTinyInteger('app_type')->comment('1.专送员-Android,2.专送员-IOS,3.专送Pro-Android,4.专送Pro-IOS');
            $table->unsignedTinyInteger('is_must_update')->default(0)->comment('是否强制更新：0.不强制、1.强制');
            $table->string('download_path', 100)->default('')->comment('下载地址');
            $table->string('description')->comment('更新说明');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `app_version` comment 'APP版本控制表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_version');
    }
}
