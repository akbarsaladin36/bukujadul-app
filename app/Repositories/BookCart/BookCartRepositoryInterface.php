<?php

namespace App\Repositories\BookCart;

interface BookCartRepositoryInterface
{
    public function GetAll();
    public function GetAllByUser($user_uuid);
    public function GetOne($book_carts_code);
    public function GetOneBook($books_uuid_code);
    public function Create(array $data);
    public function Update($book_carts_code, array $data);
    public function Delete($book_carts_code);
}