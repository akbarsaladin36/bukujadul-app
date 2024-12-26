<?php

namespace App\Repositories\BookCategory;

interface BookCategoryRepositoryInterface
{
    public function GetAll();
    public function GetOne($book_category_code);
    public function Create(array $data);
    public function Update($book_category_code, array $data);
    public function Delete($book_category_code);
} 