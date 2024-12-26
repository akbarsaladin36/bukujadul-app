<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPayment extends Model
{
    protected $table = 'bj_books_payment';

    protected $primaryKey = 'books_payment_id';

    public $timestamps = false;

    protected $fillable = [
        'user_uuid',
        'books_invoice_code',
        'books_payment_code',
        'books_payment_price',
        'books_payment_quantity',
        'books_payment_description',
        'books_payment_status_cd',
        'books_payment_created_date',
        'books_payment_created_user_uuid',
        'books_payment_created_user_username',
        'books_payment_updated_date',
        'books_payment_updated_user_uuid',
        'books_payment_updated_user_username'
    ];
}
