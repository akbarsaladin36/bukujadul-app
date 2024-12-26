<?php

namespace App\Repositories\BookMessage;

use App\BookMessage;

class BookMessageRepository implements BookMessageRepositoryInterface
{
    public function GetAll()
    {
        return BookMessage::all();
    }

    public function GetAllByUserId($user_uuid)
    {
        return BookMessage::where('sender_uuid', $user_uuid)->orWhere('receiver_uuid', $user_uuid)->get();
    }

    public function GetAllBySender($user_uuid)
    {
        return BookMessage::where('sender_uuid', $user_uuid)->get();
    }

    public function GetAllByReceiver($user_uuid)
    {
        return BookMessage::where('receiver_uuid', $user_uuid)->get();
    }

    public function GetOne($message_code)
    {
        return BookMessage::where('messages_code', $message_code)->first();
    }

    public function Create(array $data)
    {
        return BookMessage::create($data);
    }

    public function Update($message_code, array $data)
    {
        return BookMessage::where('messages_code', $message_code)->update($data);
    }

    public function Delete($message_code)
    {
        return BookMessage::where('messages_code', $message_code)->delete();
    }
}
