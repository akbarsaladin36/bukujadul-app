<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Helper
{
    public static function GetResponse($status = null, $message = '', $data = [])
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $status);
    }

    public static function HashPassword($password = '')
    {
        return Hash::make($password);
    }

    public static function GenerateUuid()
    {
        return str_replace("-", "", Str::uuid());
    }

    public static function SlugString($string)
    {
        return Str::slug($string);
    }

    public static function GetDatetime()
    {
        return date("Y-m-d H:i:s");
    }

    public static function GetExpiredDatetime($datetime = '')
    {
        return date("Y-m-d H:i:s", strtotime("+1 day", strtotime($datetime)));
    }

    public static function CheckUserToken($username)
    {
        return DB::table('bj_sessions')->where('user_username', $username)->first();
    }

    public static function GenerateToken()
    {
        return Str::random(150);
    }

    public static function CheckPassword($user_password, $input_password)
    {
        return Hash::check($input_password, $user_password);
    }

    public static function GetToken($token)
    {
        return DB::table('bj_sessions')->where('session_token', $token)->first();
    }

    public static function CreateToken(array $data)
    {
        return DB::table('bj_sessions')->insert($data);
    }

    public static function UpdateToken($username, array $data)
    {
        return DB::table('bj_sessions')->where('user_username', $username)->update($data);
    }

    public static function GetLoggedInUser(array $data)
    {
        return [
            'user_uuid' => $data["user_uuid"],
            'user_username' => $data["user_username"],
            'user_role' => $data["user_role"],
            'user_status_cd' => $data["user_status_cd"],
            'session_start_at' => $data["session_start_at"],
            'session_expired_at' => $data["session_expired_at"],
            'session_token' => $data["session_token"]
        ];
    }

    public static function GetUserRole($username)
    {
        return DB::table('bj_users')->where('user_username', $username)->first(['user_role', 'user_status_cd']);
    }

    public static function GetAuthUser(Request $request)
    {
        return (object) $request->attributes->get('logged_in_user');
    }

    public static function ToObject(array $data)
    {
        return (object) $data;
    }

    public static function ToString($data = '')
    {
        return (string) $data;
    }

    public static function ToLowerString($data = '')
    {
        return strtolower($data);
    }

    public static function GenerateRandomCode()
    {
        return Str::random(50);
    }

    public static function GenerateInvoice($date, $formatInvoice)
    {
        $randomNumber = mt_rand(10000, 999999999);
        return 'BJ-'.$formatInvoice.'-'.$date.'-'.$randomNumber;
    }

    public static function ReplaceString($search, $replace, $string)
    {
        return str_replace($search, $replace, $string);
    }

    public static function GetProfileResponse(array $data)
    {
        return [
            'user_first_name' => $data["user_first_name"],
            'user_last_name' => $data["user_last_name"],
            'user_address' => $data["user_address"],
            'user_phone_number' => $data["user_phone_number"],
            'user_balance_transaction_amount' => $data["user_balance_transaction_amount"]
        ];
    }
}
