<?php

namespace App\Services\User;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function GetAllUsers()
    {
        $checkUsers = $this->userRepository->GetAll();

        if($checkUsers->isEmpty()) {
            return Helper::GetResponse(200, 'All users is empty! Please create a new user!', []);
        }

        return Helper::GetResponse(200, 'All users is succesfully appeared!', $checkUsers);
    }

    public function GetOneUser($username)
    {
        $checkUser = $this->userRepository->GetOne($username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A username '.$username.' is not exist! Please try again!', []);
        }

        return Helper::GetResponse(200, 'A username '.$username.' data are succesfully appeared!', $checkUser);
    }

    public function CreateUser(Request $request)
    {
        $loggedInUser = Helper::GetAuthUser($request);

        $checkUser =  $this->userRepository->GetOne($request->user_username);

        if($checkUser) {
            return Helper::GetResponse(400, 'A username '.$request->user_username.' is exist! Please try again!', []);
        }

        if($loggedInUser->user_role != 'admin') {
            return Helper::GetResponse(401, 'This process can be used by admin!', []);
        }

        $user_uuid = Helper::GenerateUuid();
        $user_role = 'user';
        $user_status_cd = 'active';
        $data = [
            'user_uuid' => $user_uuid,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'user_password' => Helper::HashPassword($request->user_password),
            'user_balance_transaction_amount' => 0,
            'user_status_cd' => $user_status_cd,
            'user_role' => $user_role,
            'created_user_date' => Helper::GetDatetime(),
            'created_user_uuid' => $loggedInUser->user_uuid,
            'created_user_username' => $loggedInUser->user_username
        ];

        $this->userRepository->Create($data);

        return Helper::GetResponse(200, 'A new user is succesfully created!', $data);
    }

    public function UpdateUser($username, Request $request)
    {
        $loggedInUser = Helper::GetAuthUser($request);

        $checkUser =  $this->userRepository->GetOne($username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A username '.$username.' is not exist! Please try again!', []);
        }

        if($loggedInUser->user_role != 'admin') {
            return Helper::GetResponse(401, 'This process can be used by admin!', []);
        }

        $data = [
            'user_first_name' => $request->user_first_name,
            'user_last_name' => $request->user_last_name,
            'user_address' => $request->user_address,
            'user_phone_number' => $request->user_phone_number,
            'updated_user_date' => Helper::GetDatetime(),
            'updated_user_uuid' => $loggedInUser->user_uuid,
            'updated_user_username' => $loggedInUser->user_username
        ];

        $this->userRepository->Update($username, $data);

        return Helper::GetResponse(200, 'An existing user is succesfully updated!', $data);

    }

    public function DeleteUser($username, Request $request)
    {
        $loggedInUser = Helper::GetAuthUser($request);

        $checkUser =  $this->userRepository->GetOne($username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A username '.$username.' is not exist! Please try again!', []);
        }

        if($loggedInUser->user_role != 'admin') {
            return Helper::GetResponse(401, 'This process can be used by admin!', []);
        }

        $this->userRepository->Delete($username);

        return Helper::GetResponse(200, 'An existing user is succesfully deleted!');
    }
}