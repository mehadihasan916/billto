<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplateInvoiceCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complate_invoice_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('count_invoice_id')->default(1);
            $table->integer('invoice_count_total');
            $table->integer('current_invoice_total');
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
        Schema::dropIfExists('complate_invoice_counts');
    }
}
