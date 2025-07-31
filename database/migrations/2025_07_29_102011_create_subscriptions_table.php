<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('package_id')->nullable(); // Added package_id to link to SubscriptionPackage
            $table->foreignId('payment_record_id')->nullable();
            $table->string('name');
            $table->string('price');
            $table->string('invoice_template')->nullable();
            $table->string('invoice_generate')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->default(1)->comment('0=inactive, 1=active');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
