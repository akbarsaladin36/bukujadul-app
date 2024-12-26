<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'bj_books';

    protected $primaryKey = 'books_id';

    public $timestamps = false;

    protected $fillable = [
        'books_category_code',
        'books_uuid_code', 
        'books_title', 
        'books_slug',
        'books_description',
        'books_tags',
        'books_price',
        'books_quantity',
        'books_status_cd',
        'created_books_user_date', 
        'created_books_user_uuid',
        'created_books_user_username',
        'updated_books_user_date',
        'updated_books_user_uuid',
        'updated_books_user_username',
    ];
}
