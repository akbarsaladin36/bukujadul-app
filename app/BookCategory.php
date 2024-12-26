<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'bj_books_category';

    protected $primaryKey = 'book_category_id';

    public $timestamps = false;

    protected $fillable = [
        'book_category_code',
        'book_category_name',
        'book_category_description',
        'book_category_tags',
        'book_category_status_cd',
        'created_book_category_date',
        'created_book_category_user_uuid',
        'created_book_category_user_username',
        'updated_book_category_date',
        'updated_book_category_user_uuid',
        'updated_book_category_user_username'
    ];

    
}
