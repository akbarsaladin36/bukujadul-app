<?php

namespace App\Repositories\Book;

use App\Book;

class BookRepository implements BookRepositoryInterface
{
    public function GetAll()
    {
        return Book::all();
    }

    public function GetOne($book_slug)
    {
        return Book::where('books_slug', $book_slug)->first();
    }

    public function Create(array $data)
    {
        return Book::create($data);
    }

    public function Update($book_slug, array $data)
    {
        return Book::where('books_slug', $book_slug)->update($data);
    }

    public function Delete($book_slug)
    {
        return Book::where('books_slug', $book_slug)->delete();
    }
}