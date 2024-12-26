<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function RegisterUser(Request $request)
    {
        $user_uuid = Helper::GenerateUuid();
        $user_role = 'user';
        $user_status_cd = 'active';
        $data = [
            'user_uuid' => $user_uuid,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'user_password' => Helper::HashPassword($request->user_password),
            'user_status_cd' => $user_status_cd,
            'user_role' => $user_role,
            'created_user_date' => Helper::GetDatetime(),
            'created_user_uuid' => $user_uuid,
            'created_user_username' => $request->user_username
        ];
        $this->authService->Register($data["user_username"], $data);
        return Helper::GetResponse(200, 'A new user is succesfully created!', $data);
    }

    public function LoginUser(Request $request)
    {
        $loginUser = $this->authService->Login($request->user_username, $request->user_password);

        return Helper::GetResponse(200, 'User is succesfully login!', $loginUser);
    }
}
