<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookCategory\BookCategoryService;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    protected $bookCategoryService;

    public function __construct(BookCategoryService $bookCategoryService)
    {
        $this->bookCategoryService = $bookCategoryService;
    }

    public function GetAllBookCategories()
    {
        return $this->bookCategoryService->GetBookCategories();
    }

    public function GetOneBookCategory($book_category_code)
    {
        return $this->bookCategoryService->GetBookCategory($book_category_code);
    }

    public function CreateBookCategory(Request $request)
    {
        return $this->bookCategoryService->CreateBookCategory($request);
    }

    public function UpdateBookCategory($book_category_code, Request $request)
    {
        return $this->bookCategoryService->UpdateBookCategory($book_category_code, $request);
    }

    public function DeleteBookCategory($book_category_code)
    {
        return $this->bookCategoryService->DeleteBookCategory($book_category_code);
    }


}
