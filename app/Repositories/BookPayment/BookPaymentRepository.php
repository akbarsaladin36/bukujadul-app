<?php

namespace App\Repositories\BookPayment;

use App\Book;
use App\BookCart;
use App\BookInvoice;
use App\BookPayment;

class BookPaymentRepository implements BookPaymentRepositoryInterface
{
    public function GetAll()
    {
        return BookPayment::all();
    }

    public function GetAllByUserId($user_uuid)
    {
        return BookPayment::where('user_uuid', $user_uuid)->get();
    }

    public function GetOne($book_payment_code)
    {
        return BookPayment::where('books_payment_code', $book_payment_code)->first();
    }

    public function GetInvoice($book_invoice_code)
    {
        return BookInvoice::where('books_invoice_code', $book_invoice_code)->first();
    }

    public function GetCart($book_cart_code)
    {
        return BookCart::where('books_carts_code', $book_cart_code)->first();
    }

    public function GetBook($book_uuid_code)
    {
        return Book::where('books_uuid_code', $book_uuid_code)->first();
    }

    public function Create(array $data)
    {
        return BookPayment::create($data);
    }

    public function Update($book_payment_code, array $data)
    {
        return BookPayment::where('books_payment_code', $book_payment_code)->update($data);
    }

    public function UpdateInvoice($book_invoice_code, array $data)
    {
        return BookInvoice::where('books_invoice_code', $book_invoice_code)->update($data);
    }

    public function UpdateCart($book_cart_code, array $data)
    {
        return BookCart::where('books_carts_code', $book_cart_code)->update($data);
    }

    public function UpdateBook($book_uuid_code, array $data)
    {
        return Book::where('books_uuid_code', $book_uuid_code)->update($data);
    }

    public function Delete($book_payment_code)
    {
        return BookPayment::where('books_payment_code', $book_payment_code)->delete();
    }
}
