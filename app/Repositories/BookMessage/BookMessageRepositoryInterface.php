<?php

namespace App\Repositories\BookMessage;

interface BookMessageRepositoryInterface
{
    public function GetAll();
    public function GetAllByUserId($user_uuid);
    public function GetAllBySender($user_uuid);
    public function GetAllByReceiver($user_uuid);
    public function GetOne($message_code);
    public function Create(array $data);
    public function Update($message_code, array $data);
    public function Delete($message_code);
}