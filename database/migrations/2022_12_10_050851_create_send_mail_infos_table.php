<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendMailInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_mail_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('send_mail_to');
            $table->string('mail_subject');
            $table->text('mail_body');
            $table->integer('invoice_tamplate_id');
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
        Schema::dropIfExists('send_mail_infos');
    }
}
