<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $table = 'bj_users';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_uuid',
        'user_username', 
        'user_email', 
        'user_password',
        'user_first_name',
        'user_last_name',
        'user_address',
        'user_phone_number',
        'user_balance_transaction_amount',
        'user_role', 
        'user_status_cd',
        'created_user_date', 
        'created_user_uuid',
        'created_user_username',
        'updated_user_date',
        'updated_user_uuid',
        'updated_user_username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
