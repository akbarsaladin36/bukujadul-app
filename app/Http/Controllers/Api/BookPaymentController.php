<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookPayment\BookPaymentService;
use Illuminate\Http\Request;

class BookPaymentController extends Controller
{
    protected $bookPaymentService;

    public function __construct(BookPaymentService $bookPaymentService)
    {
        $this->bookPaymentService = $bookPaymentService;
    }

    public function GetAllPayments()
    {
        return $this->bookPaymentService->GetPayments();
    }

    public function GetAllPaymentsByUserId(Request $request)
    {
        return $this->bookPaymentService->GetPaymentsByUserId($request);
    }

    public function GetOnePayment($book_payment_code)
    {
        return $this->bookPaymentService->GetPayment($book_payment_code);
    }

    public function CreateNewPayment(Request $request)
    {
        return $this->bookPaymentService->CreatePayment($request);
    }

    public function UpdatePayment($book_payment_code, Request $request)
    {
        return $this->bookPaymentService->UpdatePaymentStatus($book_payment_code, $request);
    }

    public function DeletePayment($book_payment_code)
    {
        return $this->bookPaymentService->DeletePayment($book_payment_code);
    }
}
