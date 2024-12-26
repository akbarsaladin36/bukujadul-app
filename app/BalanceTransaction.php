<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    protected $table = 'bj_balance_transactions';

    protected $primaryKey = 'balance_transaction_id';

    public $timestamps = false;

    protected $fillable = [
        'balance_transaction_uuid',
        'balance_transaction_sender_id',
        'balance_transaction_receiver_id',
        'balance_transaction_history_in_amount',
        'balance_transaction_history_out_amount',
        'balance_transaction_description',
        'balance_transaction_process_cd',
        'balance_transaction_status_cd',
        'balance_transaction_created_date',
        'balance_transaction_created_user_uuid',
        'balance_transaction_created_user_username',
        'balance_transaction_updated_date',
        'balance_transaction_updated_user_uuid',
        'balance_transaction_updated_user_username',
    ];
}
