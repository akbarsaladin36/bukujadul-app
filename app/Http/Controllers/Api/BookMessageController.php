<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookMessage\BookMessageService;
use Illuminate\Http\Request;

class BookMessageController extends Controller
{
    protected $bookMessageService;

    public function __construct(BookMessageService $bookMessageService)
    {
        $this->bookMessageService = $bookMessageService;
    }

    public function GetAllMessagesData()
    {
        return $this->bookMessageService->GetAllMessages();
    }

    public function GetAllMessagesByUserIdData(Request $request)
    {
        return $this->bookMessageService->GetAllMessagesByUserId($request);
    }

    public function GetAllMessagesBySenderData(Request $request)
    {
        return $this->bookMessageService->GetAllMessagesBySender($request);
    }

    public function GetAllMessagesByReceiverData(Request $request)
    {
        return $this->bookMessageService->GetAllMessagesByReceiver($request);
    }

    public function GetOneMessageData($messages_code)
    {
        return $this->bookMessageService->GetOneMessage($messages_code);
    }

    public function CreateNewMessage(Request $request)
    {
        return $this->bookMessageService->CreateMessage($request);
    }

    public function ReplyExistingMessage($messages_code, Request $request)
    {
        return $this->bookMessageService->ReplyMessage($messages_code, $request);
    }

    public function UpdateMessage($messages_code, Request $request)
    {
        return $this->bookMessageService->UpdateMessage($messages_code, $request);
    }

    public function DeleteMessage($messages_code)
    {
        return $this->bookMessageService->DeleteMessage($messages_code);
    }

}
