<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function GetProfileData(Request $request)
    {
        return $this->profileService->GetProfile($request);
    }

    public function UpdateProfileData(Request $request)
    {
        return $this->profileService->UpdateProfile($request);
    }
}
