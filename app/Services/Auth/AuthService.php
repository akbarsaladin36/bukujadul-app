<?php

namespace App\Services\Auth;

use App\Helper\Helper;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function Register($username, array $data)
    {
        $checkUser = $this->authRepository->GetUsername($username);

        if($checkUser) {
            return Helper::GetResponse(400, 'A username is exist! Please try to find different new username!', []);
        }
        
        return $this->authRepository->Create($data);
    }

    public function Login($username, $password)
    {
        $checkUser = $this->authRepository->GetUsername($username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A username is not exist! Please register a new user now!', []);
        }

        $checkPassword = Helper::CheckPassword($checkUser->user_password, $password);

        if(!$checkPassword) {
            return Helper::GetResponse(400, 'A password are not match! Please try again!', []);
        }

        $checkToken = Helper::CheckUserToken($username);

        if($checkToken) {
            $token_updated_date = $token_started_at = Helper::GetDatetime();
            $token_updated_expired_date = Helper::GetExpiredDatetime($token_updated_date);
            $updated_token = Helper::GenerateToken();
            $data = [
                'session_token' => $updated_token,
                'user_uuid' => $checkUser->user_uuid,
                'user_username' => $checkUser->user_username,
                'session_start_at' => $token_started_at,
                'session_expired_at' => $token_updated_expired_date,
                'session_updated_at' => $token_updated_date
            ];
            Helper::UpdateToken($checkUser->user_username, $data);
        } else {
            $token_created_date = $token_started_at =  Helper::GetDatetime();
            $token_expired_date = Helper::GetExpiredDatetime($token_created_date);
            $user_token = Helper::GenerateToken();
            $data = [
                'session_token' => $user_token,
                'user_uuid' => $checkUser->user_uuid,
                'user_username' => $checkUser->user_username,
                'session_start_at' => $token_started_at,
                'session_expired_at' => $token_expired_date,
                'session_created_at' => $token_created_date
            ];
            Helper::CreateToken($data);
        }

        $data['user_role'] = $checkUser->user_role;
        $data['user_status_cd'] = $checkUser->user_status_cd;
        $GetLoggedInUser = Helper::GetLoggedInUser($data);

        return $GetLoggedInUser;
    }
}