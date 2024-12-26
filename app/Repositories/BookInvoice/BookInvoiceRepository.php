<?php

namespace App\Repositories\BookInvoice;

use App\BookCart;
use App\BookInvoice;

class BookInvoiceRepository implements BookInvoiceRepositoryInterface
{
    public function GetAll()
    {
        return BookInvoice::all();
    }

    public function GetAllByUserId($user_uuid)
    {
        return BookInvoice::where('user_uuid', $user_uuid)->get();
    }

    public function GetOne($book_invoice_code)
    {
        return BookInvoice::where('books_invoice_code', $book_invoice_code)->first();
    }

    public function GetOneBookCart($book_cart_code)
    {
        return BookCart::where('books_carts_code', $book_cart_code)->first();
    }

    public function Create(array $data)
    {
        return BookInvoice::create($data);
    }

    public function Update($book_invoice_code, array $data)
    {
        return BookInvoice::where('books_invoice_code', $book_invoice_code)->update($data);
    }

    public function Delete($book_invoice_code)
    {
        return BookInvoice::where('books_invoice_code', $book_invoice_code)->delete();
    }
}
