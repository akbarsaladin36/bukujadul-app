<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCart extends Model
{
    protected $primaryKey = 'books_carts_id';

    protected $table = 'bj_books_carts';

    public $timestamps = false;

    protected $fillable = [
        'user_uuid',
        'books_carts_code', 
        'books_uuid_code', 
        'books_carts_quantity',
        'books_carts_price',
        'books_carts_description',
        'books_carts_status_cd',
        'created_books_carts_date',
        'created_books_carts_user_uuid', 
        'created_books_carts_user_username',
        'updated_books_carts_date',
        'updated_books_carts_user_uuid',
        'updated_books_carts_user_username',
    ];
}
