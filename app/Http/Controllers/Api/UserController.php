<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function GetUsers()
    {
        return $this->userService->GetAllUsers();
    }

    public function GetUser($username)
    {
        return $this->userService->GetOneUser($username);
    }

    public function CreateUser(Request $request)
    {
        return $this->userService->CreateUser($request);
    }

    public function UpdateUser($username, Request $request)
    {
        return $this->userService->UpdateUser($username, $request);
    }

    public function DeleteUser($username, Request $request)
    {
        return $this->userService->DeleteUser($username, $request);
    }
}
