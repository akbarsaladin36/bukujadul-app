<?php

namespace App\Services\BookCart;

use App\Helper\Helper;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookCart\BookCartRepositoryInterface;
use Illuminate\Http\Request;

class BookCartService
{
    protected $bookCartRepository;

    public function __construct(BookCartRepositoryInterface $bookCartRepository)
    {
        $this->bookCartRepository = $bookCartRepository;
    }

    public function GetAllBookCarts()
    {
        $bookCarts = $this->bookCartRepository->GetAll();

        if($bookCarts->isEmpty()) {
            return Helper::GetResponse(200, 'All carts is empty!', []);
        }

        return Helper::GetResponse(200, 'All carts is succesfully appeared!', $bookCarts);
    }

    public function GetOneBookCarts($book_carts_code)
    {
        $bookCart = $this->bookCartRepository->GetOne($book_carts_code);

        if(!$bookCart) {
            return Helper::GetResponse(400, 'The cart ' . $book_carts_code . ' is not found!', []);
        }

        return Helper::GetResponse(200, 'The cart ' . $book_carts_code . ' data is succesfully appeared!', $bookCart);
    }

    public function GetAllBookCartsByUserId(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $ownBookCarts = $this->bookCartRepository->GetAllByUser($authUser->user_uuid);

        if($ownBookCarts->isEmpty()) {
            return Helper::GetResponse(200, 'My carts is empty!', []);
        }

        return Helper::GetResponse(200, 'My carts is succesfully appeared!', $ownBookCarts);
    }

    public function CreateBookCart(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $book = $this->bookCartRepository->GetOneBook($request->books_uuid_code);

        if(!$book) {
            return Helper::GetResponse(400, 'The book data ' . $book . ' is not found!', []);
        }

        $books_cart_price = intval($request->books_carts_quantity) * intval($book->books_price);

        $book_carts_code = Helper::GenerateRandomCode();
        $book_carts_status_cd = 'pending';
        $data = [
            'user_uuid' => $authUser->user_uuid,
            'books_uuid_code' => $book->books_uuid_code,
            'books_carts_code' => $book_carts_code,
            'books_carts_quantity' => $request->books_carts_quantity,
            'books_carts_price' => $books_cart_price,
            'books_carts_description' => $request->books_carts_description,
            'books_carts_status_cd' => $book_carts_status_cd,
            'created_books_carts_date' => Helper::GetDatetime(),
            'created_books_carts_user_uuid' => $authUser->user_uuid,
            'created_books_carts_user_username' => $authUser->user_username
        ];

        $this->bookCartRepository->Create($data);

        return Helper::GetResponse(200, 'A new cart is succesfully added!', $data);
    }

    public function UpdateBookCart($book_carts_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $bookCart = $this->bookCartRepository->GetOne($book_carts_code);

        if(!$bookCart) {
            return Helper::GetResponse(400, 'The cart ' . $book_carts_code . ' is not found!', []);
        }

        $data = [
            'books_carts_quantity' => empty($request->books_carts_quantity) ? $bookCart->books_carts_quantity : $request->books_carts_quantity,
            'books_carts_price' => empty($request->books_carts_price) ? $bookCart->books_carts_price : $request->books_carts_price,
            'books_carts_description' => empty($request->books_carts_description) ? $bookCart->books_carts_description : $request->books_carts_description,
            'books_carts_status_cd' => empty($request->books_carts_status_cd) ? $bookCart->books_carts_status_cd : $request->books_carts_status_cd,
            'updated_books_carts_date' => Helper::GetDatetime(),
            'updated_books_carts_user_uuid' => $authUser->user_uuid,
            'updated_books_carts_user_username' => $authUser->user_username
        ];

        $this->bookCartRepository->Update($book_carts_code, $data);

        return Helper::GetResponse(200, 'A cart code ' . $book_carts_code . ' is succesfully updated!', $data);
    }

    public function DeleteBookCart($book_carts_code)
    {
        $bookCart = $this->bookCartRepository->GetOne($book_carts_code);

        if(!$bookCart) {
            return Helper::GetResponse(400, 'The cart ' . $book_carts_code . ' is not found!', []);
        }

        $this->bookCartRepository->Delete($book_carts_code);

        return Helper::GetResponse(200, 'A cart code ' . $book_carts_code . ' is succesfully deleted!', []);
    }
}