<?php

namespace Polashmahmud\Bkash\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bkash extends Model
{
    use HasFactory;

    protected $fillable = [
        'paymentID',
        'trxID',
        'transactionStatus',
        'amount',
        'currency',
        'intent',
        'paymentExecuteTime',
        'merchantInvoiceNumber',
        'payerReference',
        'customerMsisdn',
        'statusCode',
        'statusMessage',
        'refundTrxID',
        'refundTransactionStatus',
        'refundAmount',
        'refundCurrency',
        'refundCharge',
        'refundCompletedTime',
        'refundStatusCode',
        'refundStatusMessage'
    ];
}
