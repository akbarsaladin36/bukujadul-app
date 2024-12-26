<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Book\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function GetAllBooks()
    {
        return $this->bookService->GetBooks();
    }

    public function GetOneBook($book_slug)
    {
        return $this->bookService->GetBook($book_slug);
    }

    public function CreateBook(Request $request)
    {
        return $this->bookService->CreateBook($request);
    }

    public function UpdateBook($book_slug, Request $request)
    {
        return $this->bookService->UpdateBook($book_slug, $request);
    }

    public function DeleteBook($book_slug)
    {
        return $this->bookService->DeleteBook($book_slug);
    }
}
