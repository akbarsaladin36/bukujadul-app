<?php

namespace App\Services\BookCategory;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Repositories\BookCategory\BookCategoryRepositoryInterface;

class BookCategoryService
{
    protected $bookCategoryRepository;

    public function __construct(BookCategoryRepositoryInterface $bookCategoryRepository)
    {
        $this->bookCategoryRepository = $bookCategoryRepository;
    }

    public function GetBookCategories()
    {
        $bookCategories = $this->bookCategoryRepository->GetAll();

        if($bookCategories->isEmpty()) {
            return Helper::GetResponse(200, 'All book categories are empty! Please create a new books', []);
        }

        return Helper::GetResponse(200, 'All book categories are succesfully appeared!', $bookCategories);
    }

    public function GetBookCategory($book_category_code)
    {
        $bookCategory = $this->bookCategoryRepository->GetOne($book_category_code);

        if(!$bookCategory) {
            return Helper::GetResponse(400, 'The book category '.$book_category_code.' is not exist! Please try again!', []);
        }

        return Helper::GetResponse(200, 'The book category '.$book_category_code.' is succesfully appeared!', $bookCategory);
    }

    public function CreateBookCategory(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $categoryCode = Helper::ToLowerString($request->book_category_name);

        $bookCategory = $this->bookCategoryRepository->GetOne($categoryCode);

        if($bookCategory) {
            return Helper::GetResponse(400, 'The book category '.$categoryCode.' is exist! Please try again!', []);
        }

        $book_category_status_cd = 'active';
        $data = [
            'book_category_code' => $categoryCode,
            'book_category_name' => $request->book_category_name,
            'book_category_description' => $request->book_category_description,
            'book_category_tags' => $request->book_category_tags,
            'book_category_status_cd' => $book_category_status_cd,
            'created_book_category_date' => Helper::GetDatetime(),
            'created_book_category_user_uuid' => $authUser->user_uuid,
            'created_book_category_user_username' => $authUser->user_username 
        ];

        $this->bookCategoryRepository->Create($data);

        return Helper::GetResponse(200, 'A new book category are succesfully created!', $data);
    }

    public function UpdateBookCategory($book_category_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $bookCategory = $this->bookCategoryRepository->GetOne($book_category_code);

        if(!$bookCategory) {
            return Helper::GetResponse(400, 'The book category '.$book_category_code.' is not exist! Please try again!', []);
        }

        $categoryCode = Helper::ToLowerString($request->book_category_name);
        $data = [
            'book_category_code' => $categoryCode,
            'book_category_name' => $request->book_category_name,
            'book_category_description' => $request->book_category_description,
            'book_category_tags' => $request->book_category_tags,
            'book_category_status_cd' => $request->book_category_status_cd,
            'updated_book_category_date' => Helper::GetDatetime(),
            'updated_book_category_user_uuid' => $authUser->user_uuid,
            'updated_book_category_user_username' => $authUser->user_username 
        ];

        $this->bookCategoryRepository->Update($book_category_code, $data);

        return Helper::GetResponse(200, 'The book category data '.$book_category_code.' is succesfully updated!', $data);
    }

    public function DeleteBookCategory($book_category_code)
    {
        $bookCategory = $this->bookCategoryRepository->GetOne($book_category_code);

        if(!$bookCategory) {
            return Helper::GetResponse(400, 'The book category '.$book_category_code.' is not exist! Please try again!', []);
        }

        $this->bookCategoryRepository->Delete($book_category_code);

        return Helper::GetResponse(200, 'The book category data '.$book_category_code.' is succesfully deleted!', []);
    }
}