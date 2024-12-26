<?php

namespace App\Services\Profile;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Repositories\Profile\ProfileRepositoryInterface;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function GetProfile(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $checkUser = $this->profileRepository->GetOne($authUser->user_username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A profile for username '.$authUser->user_username.' is not exist! Please try again!', []);
        }

        $ProfileRsps = Helper::GetProfileResponse($checkUser->toArray());

        return Helper::GetResponse(200, 'A profile for username '.$authUser->user_username.' is succesfully appeared!', $ProfileRsps);
    }

    public function UpdateProfile(Request $request)
    {
        $authUser = Helper::GetAuthUser($request);

        $checkUser = $this->profileRepository->GetOne($authUser->user_username);

        if(!$checkUser) {
            return Helper::GetResponse(400, 'A profile for username '.$authUser->user_username.' is not exist! Please try again!', []);
        }

        $data = [
            'user_first_name' => empty($checkUser->user_first_name) ? $checkUser->user_first_name : $request->user_first_name,
            'user_last_name' => empty($checkUser->user_last_name) ? $checkUser->user_last_name : $request->user_last_name,
            'user_address' => empty($checkUser->user_address) ? $checkUser->user_address : $request->user_address,
            'user_phone_number' => empty($checkUser->user_phone_number) ? $checkUser->user_phone_number : $request->user_phone_number,
            'updated_user_date' => Helper::GetDatetime(),
            'updated_user_uuid' => $authUser->user_uuid,
            'updated_user_username' => $authUser->user_username
        ];

        $this->profileRepository->Update($authUser->user_username, $data);

        return Helper::GetResponse(200, 'A profile data is succesfully updated!', $data);
    }


}