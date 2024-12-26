<?php

namespace App\Repositories\BookCategory;

use App\BookCategory;

class BookCategoryRepository implements BookCategoryRepositoryInterface
{
    public function GetAll()
    {
        return BookCategory::all();
    }

    public function GetOne($book_category_code)
    {
        return BookCategory::where('book_category_code', $book_category_code)->first();
    }

    public function Create(array $data)
    {
        return BookCategory::create($data);
    }

    public function Update($book_category_code, array $data)
    {
        return BookCategory::where('book_category_code', $book_category_code)->update($data);
    }

    public function Delete($book_category_code)
    {
        return BookCategory::where('book_category_code', $book_category_code)->delete();
    }
}