<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单主表');
            $table->string('invoice_title', 100)->comment('发票抬头');
            $table->string('invoice_content', 255)->comment('发票内容');
            $table->unsignedDecimal('invoice_amount', 10, 2)->comment('发票金额');
            $table->string('invoice_tax', 100)->comment('发票税号');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_invoice` comment '订单发票表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_invoice');
    }
}
