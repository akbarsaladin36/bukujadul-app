<?php

namespace App\Services\BookMessage;

use App\Helper\Helper;
use App\Repositories\BookMessage\BookMessageRepositoryInterface;
use Illuminate\Http\Request;

class BookMessageService
{
    protected $bookMessageRepository;

    public function __construct(BookMessageRepositoryInterface $bookMessageRepository)
    {
        $this->bookMessageRepository = $bookMessageRepository;
    }

    public function GetAllMessages()
    {
        $messages = $this->bookMessageRepository->GetAll();

        if($messages->isEmpty()) {
            return Helper::GetResponse(200, 'All messages is empty! Please create a new message!', []);
        }

        return Helper::GetResponse(200, 'All messages is succesfully appeared!', $messages);
    }

    public function GetAllMessagesByUserId(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $messages = $this->bookMessageRepository->GetAllByUserId($authUser->user_uuid);

        if($messages->isEmpty()) {
            return Helper::GetResponse(200, 'All messages by user is empty! Please create a new message!', []);
        }

        return Helper::GetResponse(200, 'All messages by user is succesfully appeared!', $messages);
    }

    public function GetAllMessagesBySender(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $senderMessages = $this->bookMessageRepository->GetAllBySender($authUser->user_uuid);

        if($senderMessages->isEmpty()) {
            return Helper::GetResponse(200, 'All messages by sender is empty! Please create a new message!', []);
        }

        return Helper::GetResponse(200, 'All messages by sender is succesfully appeared!', $senderMessages);
    }

    public function GetAllMessagesByReceiver(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $receiverMessages = $this->bookMessageRepository->GetAllByReceiver($authUser->user_uuid);

        if($receiverMessages->isEmpty()) {
            return Helper::GetResponse(200, 'All messages by receiver is empty! Please create a new message!', []);
        }

        return Helper::GetResponse(200, 'All messages by receiver is succesfully appeared!', $receiverMessages);
    }

    public function GetOneMessage($messages_code)
    {
        $message = $this->bookMessageRepository->GetOne($messages_code);

        if(!$message) {
            return Helper::GetResponse(400, 'The message code ' . $messages_code . ' is not found!', []);
        }

        return Helper::GetResponse(200, 'The message code ' . $messages_code . ' is succesfully appeared!', $message);
    }

    public function CreateMessage(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $messages_status_cd = 'sent';
        $data = [
            'sender_uuid' => $authUser->user_uuid,
            'receiver_uuid' => $request->receiver_uuid,
            'messages_code' => Helper::SlugString($request->messages_title),
            'messages_title' => $request->messages_title,
            'messages_description' => $request->messages_description,
            'messages_status_cd' => $messages_status_cd,
            'messages_created_date' => Helper::GetDatetime(),
            'messages_created_user_uuid' => $authUser->user_uuid,
            'messages_created_user_username' => $authUser->user_username,
        ];

        $this->bookMessageRepository->Create($data);

        return Helper::GetResponse(200, 'A new message are succesfully sent!', $data);
    }

    public function ReplyMessage($messages_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $receiverMessage = $this->bookMessageRepository->GetOne($messages_code);

        if(!$receiverMessage) {
            return Helper::GetResponse(400, 'The message code ' . $messages_code . ' is not found!', []);
        }

        $message_status_cd = 'reply';
        $data = [
            'sender_uuid' => $authUser->user_uuid,
            'receiver_uuid' => $receiverMessage->sender_uuid,
            'messages_code' => $receiverMessage->messages_code,
            'messages_title' => 'Reply For: '.$receiverMessage->messages_title,
            'messages_description' => $request->messages_description,
            'messages_status_cd' => $message_status_cd,
            'messages_created_date' => Helper::GetDatetime(),
            'messages_created_user_uuid' => $authUser->user_uuid,
            'messages_created_user_username' => $authUser->user_username,
        ];

        $this->bookMessageRepository->Create($data);

        return Helper::GetResponse(200, 'Replying message '. $receiverMessage->messages_code .' are succesfully sent!', $data);
    }

    public function UpdateMessage($messages_code, Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $message = $this->bookMessageRepository->GetOne($messages_code);

        if(!$message) {
            return Helper::GetResponse(400, 'The message code ' . $messages_code . ' is not found!', []);
        }

        $slug_message = Helper::SlugString($request->messages_title);
        $messages_status_cd = 'sent';
        $data = [
            'messages_code' => (empty($request->messages_title)) ? $message->messages_code : $slug_message,
            'messages_title' => (empty($request->messages_title)) ? $message->messages_title : $request->messages_title,
            'messages_description' => (empty($request->messages_description)) ? $message->messages_description : $request->messages_description,
            'messages_status_cd' => (empty($request->messages_status_cd)) ? $message->messages_status_cd : $messages_status_cd,
            'messages_updated_date' => Helper::GetDatetime(),
            'messages_updated_user_uuid' => $authUser->user_uuid,
            'messages_updated_user_username' => $authUser->user_username,
        ];

        $this->bookMessageRepository->Update($messages_code, $data);

        return Helper::GetResponse(200, 'A message' . $slug_message . ' are succesfully updated!', $data);
    }

    public function DeleteMessage($messages_code)
    {
        $message = $this->bookMessageRepository->GetOne($messages_code);

        if(!$message) {
            return Helper::GetResponse(400, 'The message code ' . $messages_code . ' is not found!', []);
        }

        $this->bookMessageRepository->Delete($messages_code);

        return Helper::GetResponse(200, 'A message are succesfully deleted!', []);
    }
}
