<?php

namespace App\Repositories\Book;

interface BookRepositoryInterface
{
    public function GetAll();
    public function GetOne($book_slug);
    public function Create(array $bookData);
    public function Update($book_slug, array $bookData);
    public function Delete($book_slug);
}