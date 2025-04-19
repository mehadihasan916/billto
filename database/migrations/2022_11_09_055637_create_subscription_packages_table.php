<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('packageName')->nullable();
            $table->string('packageNamebn')->nullable();
            $table->string('packageDuration')->nullable();
            $table->string('price')->nullable();
            $table->string('pricebn')->nullable();
            $table->string('templateQuantity')->nullable();
            $table->string('templateQuantitybn')->nullable();
            $table->string('limitInvoiceGenerate')->nullable();
            $table->string('limitInvoiceGeneratebn')->nullable();
            $table->string('templateId')->nullable();
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
        Schema::dropIfExists('subscription_packages');
    }
}
