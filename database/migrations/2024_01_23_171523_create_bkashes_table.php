<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bkashes', function (Blueprint $table) {
            $table->id();
            $table->string('paymentID')->nullable();
            $table->string('trxID')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->string('paymentExecuteTime')->nullable();
            $table->string('merchantInvoiceNumber')->nullable();
            $table->string('payerReference')->nullable();
            $table->string('customerMsisdn')->nullable();
            $table->string('statusCode')->nullable();
            $table->string('statusMessage')->nullable();
            // Refund
            $table->string('refundTrxID')->nullable();
            $table->string('refundTransactionStatus')->nullable();
            $table->string('refundAmount')->nullable();
            $table->string('refundCurrency')->nullable();
            $table->string('refundCharge')->nullable();
            $table->string('refundCompletedTime')->nullable();
            $table->string('refundStatusCode')->nullable();
            $table->string('refundStatusMessage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkashes');
    }
};
