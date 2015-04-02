<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Payment extends Eloquent {

    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'transaction_type',
        'order_time',
        'amt',
        'fee_amt',
        'payments_status',
        'pending_reason',
        'reason_code',
        'merchant_id',
        'error_code',
        'ack',
        'checkin_at'
    ];
}
