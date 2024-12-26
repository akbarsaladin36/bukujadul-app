<?php

namespace App\Services\BalanceTransaction;

use App\Helper\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\BalanceTransaction\BalanceTransactionRepositoryInterface;

class BalanceTransactionService
{
    protected $balanceTransactionRepository;

    public function __construct(BalanceTransactionRepositoryInterface $balanceTransactionRepository)
    {
        $this->balanceTransactionRepository = $balanceTransactionRepository;
    }

    public function GetAllBalanceTransactions()
    {
        $balanceTransactions = $this->balanceTransactionRepository->GetAll();

        if($balanceTransactions->isEmpty()) {
            return Helper::GetResponse(200, 'All balance transactions is empty!', []);
        }

        return Helper::GetResponse(200, 'All balance transactions data is succesfully appeared!', $balanceTransactions);
    }

    public function GetAllBalanceTransactionsByUserId(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $balanceTransactions = $this->balanceTransactionRepository->GetAllByUserId($authUser->user_uuid);

        if($balanceTransactions->isEmpty()) {
            return Helper::GetResponse(200, 'All balance transactions for user ' . $authUser->user_username . ' is empty!', []);
        }

        return Helper::GetResponse(200, 'All balance transactions for user ' . $authUser->user_username . ' is succesfully appeared!', $balanceTransactions);
    }

    public function GetOneBalanceTransaction($balance_transaction_uuid)
    {
        $balanceTransaction = $this->balanceTransactionRepository->GetOne($balance_transaction_uuid);

        if(!$balanceTransaction) {
            return Helper::GetResponse(404, 'A balance transaction data ' . $balance_transaction_uuid . ' is not found!', []);
        }

        return Helper::GetResponse(200, 'A balance transaction data ' . $balance_transaction_uuid . ' is succesfully appeared!', $balanceTransaction);
    }

    public function CreateBalanceTransaction(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $user = $this->balanceTransactionRepository->GetUser($authUser->user_uuid);

        if(!$user) {
            return Helper::GetResponse(404, 'A balance transaction data from username' . $authUser->user_username . ' is not found!', []);
        }

        $balance_transaction_uuid = Helper::GenerateUuid();
        $balance_transaction_status_cd = 'sent';
        $data = [
            'balance_transaction_uuid' => $balance_transaction_uuid,
            'balance_transaction_sender_id' => $authUser->user_uuid,
            'balance_transaction_receiver_id' => $request->balance_transaction_receiver_id,
            'balance_transaction_history_in_amount' => empty($request->balance_transaction_history_in_amount) ? 0 : $request->balance_transaction_history_in_amount,
            'balance_transaction_history_out_amount' => empty($request->balance_transaction_history_out_amount) ? 0 : $request->balance_transaction_history_out_amount,
            'balance_transaction_description' => $request->balance_transaction_description,
            'balance_transaction_process_cd' => $request->balance_transaction_process_cd,
            'balance_transaction_status_cd' => $balance_transaction_status_cd,
            'balance_transaction_created_date' => Helper::GetDatetime(),
            'balance_transaction_created_user_uuid' => $authUser->user_uuid,
            'balance_transaction_created_user_username' => $authUser->user_username
        ];

        $this->balanceTransactionRepository->Create($data);

        if($request->balance_transaction_process_cd == 'top-up') {
            $balanceAmount = intval($user->user_balance_transaction_amount) + intval($request->balance_transaction_history_in_amount);
            $update_data_transaction = [
                'user_balance_transaction_amount' => $balanceAmount,
                'updated_user_date' => Helper::GetDatetime(),
                'updated_user_uuid' => $authUser->user_uuid,
                'updated_user_username' => $authUser->user_username
            ];
            $this->balanceTransactionRepository->UpdateUserBalanceTransaction($authUser->user_uuid, $update_data_transaction);
        }

        if($request->balance_transaction_process_cd == 'transfer') {
            $balanceAmount = intval($user->user_balance_transaction_amount) - intval($request->balance_transaction_history_out_amount);
            $update_data_transaction = [
                'user_balance_transaction_amount' => $balanceAmount,
                'updated_user_date' => Helper::GetDatetime(),
                'updated_user_uuid' => $authUser->user_uuid,
                'updated_user_username' => $authUser->user_username
            ];
            $this->balanceTransactionRepository->UpdateUserBalanceTransaction($authUser->user_uuid, $update_data_transaction);
        }

        return Helper::GetResponse(200, 'A new transaction is succesfully created!', $data);
    }    
}