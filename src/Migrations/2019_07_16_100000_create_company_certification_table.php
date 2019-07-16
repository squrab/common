<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_certification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('身份标识');
            $table->string('social_credit_code', 18)->comment('统一信用代码');
            $table->unsignedInteger('license_image_id')->comment('营业执照');
            $table->timestamps();

            $table->unique('user_id');
        });

        DB::statement("ALTER TABLE `company_certification` comment '企业认证资料表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_certification');
    }
}
