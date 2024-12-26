<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookInvoice\BookInvoiceService;
use Illuminate\Http\Request;

class BookInvoiceController extends Controller
{
    protected $bookInvoiceService;

    public function __construct(BookInvoiceService $bookInvoiceService)
    {
        $this->bookInvoiceService = $bookInvoiceService;
    }

    public function GetAllInvoices()
    {
        return $this->bookInvoiceService->GetAllBookInvoices();
    }

    public function GetAllInvoicesByUserId(Request $request)
    {
        return $this->bookInvoiceService->GetAllBookInvoicesByUserId($request);
    }

    public function GetOneInvoice($book_invoice_code)
    {
        return $this->bookInvoiceService->GetBookInvoice($book_invoice_code);
    }

    public function CreateNewInvoice(Request $request)
    {
        return $this->bookInvoiceService->CreateInvoice($request);
    }

    public function UpdateInvoiceStatus($book_invoice_code, Request $request)
    {
        return $this->bookInvoiceService->UpdateInvoiceStatus($book_invoice_code, $request);
    }

    public function DeleteInvoice($book_invoice_code)
    {
        return $this->bookInvoiceService->DeleteInvoice($book_invoice_code);
    }
}
