<?php

namespace App\Services\BookInvoice;

use App\Helper\Helper;
use App\Repositories\BookInvoice\BookInvoiceRepositoryInterface;
use Illuminate\Http\Request;

class BookInvoiceService
{
    protected $bookInvoiceRepository;

    public function __construct(BookInvoiceRepositoryInterface $bookInvoiceRepository)
    {
        $this->bookInvoiceRepository = $bookInvoiceRepository;
    }

    public function GetAllBookInvoices()
    {
        $invoices = $this->bookInvoiceRepository->GetAll();

        if($invoices->IsEmpty()) {
            return Helper::GetResponse(200, 'An invoice data is empty. Please create a new one!', []);
        }

        return Helper::GetResponse(200, 'All invoices are succesfully appeared!', $invoices);
    }

    public function GetAllBookInvoicesByUserId(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $invoices = $this->bookInvoiceRepository->GetAllByUserId($authUser->user_uuid);

        if($invoices->IsEmpty()) {
            return Helper::GetResponse(200, 'My invoices data is empty. Please create a new one!', []);
        }

        return Helper::GetResponse(200, 'My invoices data are succesfully appeared!', $invoices);
    }

    public function GetBookInvoice($book_invoice_code)
    {
        $invoice = $this->bookInvoiceRepository->GetOne($book_invoice_code);

        if(!$invoice) {
            return Helper::GetResponse(200, 'An invoice data '.$book_invoice_code.' not found!', []);
        }

        return Helper::GetResponse(200, 'Invoice data are '. $book_invoice_code .' succesfully appeared!', $invoice);
    }

    public function CreateInvoice(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $bookCart = $this->bookInvoiceRepository->GetOneBookCart($request->books_cart_code);

        if(!$bookCart) {
            return Helper::GetResponse(400, 'A book cart data ' . $request->books_cart_code . ' is not found!', []);
        }

        $date = Helper::ReplaceString('-', '', date("Y-m-d"));
        $formatNumber = 'INV-P';
        $invoiceCode = Helper::GenerateInvoice($date, $formatNumber);
        $books_invoice_status_cd = 'pending';
        $data = [
            'user_uuid' => $authUser->user_uuid,
            'books_carts_code' => $bookCart->books_carts_code,
            'books_invoice_code' => $invoiceCode,
            'books_invoice_quantity' => $bookCart->books_carts_quantity,
            'books_invoice_price' => $bookCart->books_carts_price,
            'books_invoice_description' => $request->books_invoice_description,
            'books_invoice_status_cd' => $books_invoice_status_cd,
            'books_invoice_created_date' => Helper::GetDatetime(),
            'books_invoice_created_user_uuid' => $authUser->user_uuid,
            'books_invoice_created_user_username' => $authUser->user_username
        ];

        $this->bookInvoiceRepository->Create($data);

        return Helper::GetResponse(200, 'A new invoice have been succesfully created!', $data);
    }

    public function UpdateInvoiceStatus($book_invoice_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $invoice  = $this->bookInvoiceRepository->GetOne($book_invoice_code);

        if(!$invoice) {
            return Helper::GetResponse(200, 'An invoice data '.$book_invoice_code.' not found!', []);
        }

        $books_invoice_status_cd = (empty($request->books_invoice_status_cd)) ? $invoice->books_invoice_status_cd : $request->books_invoice_status_cd;
        $data = [
            'books_invoice_status_cd' => $books_invoice_status_cd,
            'books_invoice_updated_date' => Helper::GetDatetime(),
            'books_invoice_updated_user_uuid' => $authUser->user_uuid,
            'books_invoice_updated_user_username' => $authUser->user_username
        ];

        $this->bookInvoiceRepository->Update($book_invoice_code, $data);

        return Helper::GetResponse(200, 'An invoice '. $book_invoice_code .' have been succesfully updated!', $data);
    }

    public function DeleteInvoice($book_invoice_code)
    {
        $invoice = $this->bookInvoiceRepository->GetOne($book_invoice_code);

        if(!$invoice) {
            return Helper::GetResponse(200, 'An invoice data '.$book_invoice_code.' not found!', []);
        }

        $this->bookInvoiceRepository->Delete($book_invoice_code);

        return Helper::GetResponse(200, 'An invoice has been deleted!', []);
    }
}
