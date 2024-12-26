<?php

namespace App\Repositories\BookInvoice;

interface BookInvoiceRepositoryInterface
{
    public function GetAll();
    public function GetAllByUserId($user_uuid);
    public function GetOne($book_invoice_code);
    public function GetOneBookCart($book_cart_code);
    public function Create(array $data);
    public function Update($book_invoice_code, array $data);
    public function Delete($book_invoice_code);
}
