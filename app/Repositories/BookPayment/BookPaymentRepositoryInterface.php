<?php

namespace App\Repositories\BookPayment;

interface BookPaymentRepositoryInterface
{
    public function GetAll();
    public function GetAllByUserId($user_uuid);
    public function GetOne($book_payment_code);
    public function GetInvoice($book_invoice_code);
    public function GetCart($book_cart_code);
    public function GetBook($book_uuid_code);
    public function Create(array $data);
    public function Update($book_payment_code, array $data);
    public function UpdateInvoice($book_invoice_code, array $data);
    public function UpdateCart($book_cart_code, array $data);
    public function UpdateBook($book_uuid_code, array $data);
    public function Delete($book_payment_code);
}
