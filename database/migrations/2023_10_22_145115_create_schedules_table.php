<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('order_day')->nullable()->comment('注文日');
            $table->string('management_number')->nullable()->comment('管理番号');
            $table->string('material')->nullable()->comment('生地番号');
            $table->string('img_path')->nullable()->comment('画像のパス');
            $table->string('product_name')->nullable()->comment('商品名');
            $table->integer('quantity')->nullable()->comment('数量');
            $table->string('request')->nullable()->comment('要望(至急/普通)');
            $table->date('ship_date')->nullable()->comment('出荷日');
            $table->string('delivery_status')->nullable()->comment('配送状況（出荷済み）');
            $table->date('specify_arrival_date')->nullable()->comment('到着日指定');
            $table->string('shipping_company')->nullable()->comment('運送会社');
            $table->string('slip_number')->nullable()->comment('配送伝票番号');
            $table->text('memo')->nullable()->comment('メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
