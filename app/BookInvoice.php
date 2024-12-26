<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookInvoice extends Model
{
    protected $table = 'bj_books_invoice';

    protected $primaryKey = 'books_invoice_id';

    public $timestamps = false;

    protected $fillable = [
        'user_uuid',
        'books_carts_code',
        'books_invoice_code',
        'books_invoice_quantity',
        'books_invoice_price',
        'books_invoice_description',
        'books_invoice_status_cd',
        'books_invoice_created_date',
        'books_invoice_created_user_uuid',
        'books_invoice_created_user_username',
        'books_invoice_updated_date',
        'books_invoice_updated_user_uuid',
        'books_invoice_updated_user_username'
    ];
}
