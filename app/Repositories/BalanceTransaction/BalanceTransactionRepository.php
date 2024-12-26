<?php

namespace App\Repositories\BalanceTransaction;

use App\BalanceTransaction;
use App\User;

class BalanceTransactionRepository implements BalanceTransactionRepositoryInterface
{
    public function GetAll()
    {
        return BalanceTransaction::all();
    }

    public function GetAllByUserId($user_uuid)
    {
        return BalanceTransaction::where('balance_transaction_sender_id', $user_uuid)->orWhere('balance_transaction_receiver_id', $user_uuid)->get();
    }

    public function GetOne($balance_transaction_uuid)
    {
        return BalanceTransaction::where('balance_transaction_uuid', $balance_transaction_uuid)->first();
    }

    public function GetUser($user_uuid)
    {
        return User::where('user_uuid', $user_uuid)->first();
    }

    public function Create(array $data)
    {
        return BalanceTransaction::create($data);
    }

    public function UpdateUserBalanceTransaction($user_uuid, array $data)
    {
        return User::where('user_uuid', $user_uuid)->update($data);
    }
}