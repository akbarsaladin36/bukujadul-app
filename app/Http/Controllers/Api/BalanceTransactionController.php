<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BalanceTransaction\BalanceTransactionService;
use Illuminate\Http\Request;

class BalanceTransactionController extends Controller
{
    protected $balanceTransactionService;

    public function __construct(BalanceTransactionService $balanceTransactionService)
    {
        $this->balanceTransactionService = $balanceTransactionService;
    }

    public function GetAllBalanceTransactions()
    {
        return $this->balanceTransactionService->GetAllBalanceTransactions();
    }

    public function GetAllBalanceTransactionsByUserId(Request $request)
    {
        return $this->balanceTransactionService->GetAllBalanceTransactionsByUserId($request);
    }

    public function GetOneBalanceTransaction($balance_transaction_uuid)
    {
        return $this->balanceTransactionService->GetOneBalanceTransaction($balance_transaction_uuid);
    }

    public function CreateNewBalanceTransaction(Request $request)
    {
        return $this->balanceTransactionService->CreateBalanceTransaction($request);
    }
}
