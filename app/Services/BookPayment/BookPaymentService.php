<?php

namespace App\Services\BookPayment;

use App\Helper\Helper;
use App\Repositories\BookPayment\BookPaymentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookPaymentService
{
    protected $bookPaymentRepository;

    public function __construct(BookPaymentRepositoryInterface $bookPaymentRepository)
    {
        $this->bookPaymentRepository = $bookPaymentRepository;
    }

    public function GetPayments()
    {
        $payments = $this->bookPaymentRepository->GetAll();

        if($payments->isEmpty()) {
            return Helper::GetResponse(200, 'All payments are empty! Please create a new payment', []);
        }

        return Helper::GetResponse(200, 'All payments are succesfully appeared!', $payments);
    }

    public function GetPaymentsByUserId(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $payments = $this->bookPaymentRepository->GetAllByUserId($authUser->user_uuid);

        if($payments->isEmpty()) {
            return Helper::GetResponse(400, 'All payments data from user '. $authUser->user_uuid .' are not found!', []);
        }

        return Helper::GetResponse(400, 'All payments data from user '. $authUser->user_uuid .' are succesfully appeared!', $payments);
    }

    public function GetPayment($book_payment_code)
    {
        $payment = $this->bookPaymentRepository->GetOne($book_payment_code);

        if(!$payment) {
            return Helper::GetResponse(400, 'Data payment '. $book_payment_code .' are not found!', []);
        }

        return Helper::GetResponse(200, 'Data payment '. $book_payment_code .' are succesfully appeared!', $payment);
    }

    public function CreatePayment(Request $request)
    {
         $authUser = Helper::GetAuthUser($request);

         $invoice = $this->bookPaymentRepository->GetInvoice($request->books_invoice_code);

         if(!$invoice) {
             return Helper::GetResponse(400, 'An invoice data ' . $request->books_invoice_code . ' are not found !', []);
         }

         $date = date("Y-m-d");
         $formatPayment = 'PYT';
         $payment_code = Helper::GenerateInvoice($date, $formatPayment);
         $books_payment_status_cd = 'pending';

         $data = [
             'user_uuid' => $authUser->user_uuid,
             'books_invoice_code' => $invoice->books_invoice_code,
             'books_payment_code' => $payment_code,
             'books_payment_price' => $invoice->books_invoice_price,
             'books_payment_quantity' => $invoice->books_invoice_quantity,
             'books_payment_description' => $request->books_payment_description,
             'books_payment_status_cd' => $books_payment_status_cd,
             'books_payment_created_date' => Helper::GetDatetime(),
             'books_payment_created_user_uuid' => $authUser->user_uuid,
             'books_payment_created_user_username' => $authUser->user_username
         ];

         $this->bookPaymentRepository->Create($data);

         return Helper::GetResponse(200, 'A new payment have been succesfully created!', $data);
    }

    public function UpdatePaymentStatus($books_payment_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $payment = $this->bookPaymentRepository->GetOne($books_payment_code);

        if(!$payment) {
            return Helper::GetResponse(400, 'Data payment '. $books_payment_code .' are not found!', []);
        }

        $invoice = $this->bookPaymentRepository->GetInvoice($payment->books_invoice_code);

        if(!$invoice) {
            return Helper::GetResponse(400, 'An invoice data ' . $payment->book_invoice_code . ' are not found !', []);
        }

        $bookCart = $this->bookPaymentRepository->GetCart($invoice->books_carts_code);

        if(!$bookCart) {
            return Helper::GetResponse(400, 'An book cart data ' . $invoice->books_carts_code . ' are not found !', []);
        }

        $book = $this->bookPaymentRepository->GetBook($bookCart->books_uuid_code);

        if(!$book) {
            return Helper::GetResponse(400, 'An book data ' . $bookCart->books_uuid_code . ' are not found !', []);
        }

        if($request->books_payment_status_cd == 'paid') {
            $data = [
                'books_payment_status_cd' => 'paid',
                'books_payment_updated_date' => Helper::GetDatetime(),
                'books_payment_updated_user_uuid' => $authUser->user_uuid,
                'books_payment_updated_user_username' => $authUser->user_username
            ];

            $this->bookPaymentRepository->Update($books_payment_code, $data);

            $updateInvoice = [
                'books_invoice_status_cd' => 'paid',
                'books_invoice_updated_date' => Helper::GetDatetime(),
                'books_invoice_updated_user_uuid' => $authUser->user_uuid,
                'books_invoice_updated_user_username' => $authUser->user_username
            ];

            $this->bookPaymentRepository->UpdateInvoice($payment->books_invoice_code, $updateInvoice);

            $updateCart = [
                'books_carts_status_cd' => 'paid',
                'updated_books_carts_date' => Helper::GetDatetime(),
                'updated_books_carts_user_uuid' => $authUser->user_uuid,
                'updated_books_carts_user_username' => $authUser->user_username
            ];

            $this->bookPaymentRepository->UpdateCart($invoice->books_carts_code, $updateCart);

            $updateBookQuantity = intval($book->books_quantity) - intval($payment->books_payment_quantity);

            $updateBook = [
                'books_quantity' => $updateBookQuantity,
                'updated_books_user_date' => Helper::GetDatetime(),
                'updated_books_user_uuid' => $authUser->user_uuid,
                'updated_books_user_username' => $authUser->user_username
            ];

            $this->bookPaymentRepository->UpdateBook($book->books_uuid_code, $updateBook);

            return Helper::GetResponse(200, 'A new status payment ' . $books_payment_code . ' is succesfully updated', $data);
        }

        $data = [
            'books_payment_status_cd' => $request->books_payment_status_cd,
            'books_payment_updated_date' => Helper::GetDatetime(),
            'books_payment_updated_user_uuid' => $authUser->user_uuid,
            'books_payment_updated_user_username' => $authUser->user_username
        ];

        $this->bookPaymentRepository->Update($books_payment_code, $data);

        return Helper::GetResponse(200, 'A new status payment ' . $books_payment_code . ' is succesfully updated', $data);
    }

    public function DeletePayment($books_payment_code)
    {
        $payment = $this->bookPaymentRepository->GetOne($books_payment_code);

        if(!$payment) {
            return Helper::GetResponse(400, 'Data payment ' . $books_payment_code .' are not found!', []);
        }

        if($payment->books_payment_status_cd == 'paid') {
            return Helper::GetResponse(400, 'This payment is already paid! Cannot be deleted data!', []);
        }

        $this->bookPaymentRepository->Delete($books_payment_code);

        return Helper::GetResponse(200, 'A new payment ' . $books_payment_code . ' succesfully deleted!', []);
    }



}
