<?php

namespace App\Services\Book;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Repositories\Book\BookRepositoryInterface;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function GetBooks()
    {
        $books = $this->bookRepository->GetAll();

        if($books->isEmpty()) {
            return Helper::GetResponse(200, 'All books are empty! Please create a new books', []);
        }

        return Helper::GetResponse(200, 'All books are succesfully appeared!', $books);
    }

    public function GetBook($book_slug)
    {
        $checkBook = $this->bookRepository->GetOne($book_slug);

        if(!$checkBook) {
            return Helper::GetResponse(400, 'A book data '.$book_slug.' is not found! Please try again!', []);
        }

        return Helper::GetResponse(200, 'A book data '.$book_slug.' is succesfully appeared!', $checkBook);
    }

    public function CreateBook(Request $request)
    {
        $loggedInUser = Helper::GetAuthUser($request);

        $book_slug = Helper::SlugString($request->book_title);

        $checkBook = $this->bookRepository->GetOne($book_slug);

        if($checkBook) {
            return Helper::GetResponse(400, 'A book data '.$book_slug.' is exist! Please try again!', []);
        }

        $book_uuid = Helper::GenerateUuid();
        $book_status_cd = 'active';

        $data = [
            'books_category_code' => $request->books_category_code,
            'books_uuid_code' => $book_uuid, 
            'books_title' => $request->books_title, 
            'books_slug' => Helper::SlugString($request->books_title),
            'books_description' => $request->books_description,
            'books_tags' => $request->books_tags,
            'books_price' => $request->books_price,
            'books_quantity' => $request->books_quantity,
            'books_status_cd' => $book_status_cd,
            'created_books_user_date' => Helper::GetDatetime(), 
            'created_books_user_uuid' => $loggedInUser->user_uuid,
            'created_books_user_username' => $loggedInUser->user_username,
        ];

        $this->bookRepository->Create($data);

        return Helper::GetResponse(200, 'A new book data is succesfully created!', $data);
    }

    public function UpdateBook($book_slug, Request $request)
    {
        $loggedInUser = Helper::GetAuthUser($request);

        $checkBook = $this->bookRepository->GetOne($book_slug);

        if(!$checkBook) {
            return Helper::GetResponse(400, 'A book data '.$book_slug.' is not exist! Please try again!', []);
        }

        $book_uuid = Helper::GenerateUuid();
        $book_status_cd = 'active';

        $data = [
            'books_category_code' => $request->books_category_code,
            'books_uuid_code' => $book_uuid, 
            'books_title' => $request->books_title, 
            'books_slug' => Helper::SlugString($request->books_title),
            'books_description' => $request->books_description,
            'books_tags' => $request->books_tags,
            'books_price' => $request->books_price,
            'books_quantity' => $request->books_quantity,
            'books_status_cd' => $book_status_cd,
            'updated_books_user_date' => Helper::GetDatetime(), 
            'updated_books_user_uuid' => $loggedInUser->user_uuid,
            'updated_books_user_username' => $loggedInUser->user_username,
        ];

        $this->bookRepository->Update($book_slug, $data);

        return Helper::GetResponse(400, 'A book data '.$book_slug.' are succesfully updated!', $data);
    }

    public function DeleteBook($book_slug)
    {
        $checkBook = $this->bookRepository->GetOne($book_slug);

        if(!$checkBook) {
            return Helper::GetResponse(400, 'A book data '.$book_slug.' is not exist! Please try again!', []);
        }

        $this->bookRepository->Delete($book_slug);

        return Helper::GetResponse(200, 'A book data '.$book_slug.' is succesfully deleted!', []);
    }
}