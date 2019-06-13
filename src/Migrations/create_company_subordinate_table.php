<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySubordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_subordinate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->comment('企业用户-用户表ID');
            $table->integer('subordinate_id')->unsigned()->comment('子账号用户-用户表ID');
        });

        DB::statement("ALTER TABLE `company_subordinate` comment '企业用户子账号关联表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_subordinate');
    }
}
