<?php

namespace App\Repositories\BookCart;

use App\Book;
use App\BookCart;

class BookCartRepository implements BookCartRepositoryInterface
{
    public function GetAll()
    {
        return BookCart::all();
    }

    public function GetAllByUser($user_uuid)
    {
        return BookCart::where('user_uuid', $user_uuid)->get();
    }

    public function GetOne($book_carts_code)
    {
        return BookCart::where('books_carts_code', $book_carts_code)->first();
    }

    public function GetOneBook($books_uuid_code)
    {
        return Book::where('books_uuid_code', $books_uuid_code)->first();
    }

    public function Create(array $data)
    {
        return BookCart::create($data);
    }

    public function Update($book_carts_code, array $data)
    {
        return BookCart::where('books_carts_code', $book_carts_code)->update($data);
    }

    public function Delete($book_carts_code)
    {
        return BookCart::where('books_carts_code', $book_carts_code)->delete();
    }
}