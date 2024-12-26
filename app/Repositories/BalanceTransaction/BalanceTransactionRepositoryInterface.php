<?php

namespace App\Repositories\BalanceTransaction;

interface BalanceTransactionRepositoryInterface
{
    public function GetAll();
    public function GetAllByUserId($user_uuid);
    public function GetOne($balance_transaction_uuid);
    public function GetUser($user_uuid);
    public function Create(array $data);
    public function UpdateUserBalanceTransaction($user_uuid, array $data);
}