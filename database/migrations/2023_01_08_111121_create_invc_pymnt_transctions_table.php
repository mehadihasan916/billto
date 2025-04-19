<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvcPymntTransctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invc_pymnt_transctions', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('user_id');
            $table->string('new_payment');
            $table->string('payment_date');
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
        Schema::dropIfExists('invc_pymnt_transctions');
    }
}
