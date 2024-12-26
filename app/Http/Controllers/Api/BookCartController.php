<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookCart\BookCartService;
use Illuminate\Http\Request;

class BookCartController extends Controller
{
    protected $bookCartService;

    public function __construct(BookCartService $bookCartService)
    {
        $this->bookCartService = $bookCartService;
    }

    public function GetAllBookCarts()
    {
        return $this->bookCartService->GetAllBookCarts();
    }

    public function GetOneBookCart($book_cart_code)
    {
        return $this->bookCartService->GetOneBookCarts($book_cart_code);
    }

    public function GetMyCarts(Request $request)
    {
        return $this->bookCartService->GetAllBookCartsByUserId($request);
    }

    public function CreateBookCart(Request $request)
    {
        return $this->bookCartService->CreateBookCart($request);
    }

    public function UpdateBookCart($book_cart_code, Request $request)
    {
        return $this->bookCartService->UpdateBookCart($book_cart_code, $request);
    }

    public function DeleteBookCart($book_cart_code)
    {
        return $this->bookCartService->DeleteBookCart($book_cart_code);
    }
}
