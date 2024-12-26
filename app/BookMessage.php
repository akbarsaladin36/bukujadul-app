<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookMessage extends Model
{
    public $table = 'bj_messages';

    public $primaryKey = 'messages_id';

    public $timestamps = false;

    protected $fillable = [
        'sender_uuid',
        'receiver_uuid',
        'messages_code',
        'messages_title',
        'messages_description',
        'messages_status_cd',
        'messages_created_date',
        'messages_created_user_uuid',
        'messages_created_user_username',
        'messages_updated_date',
        'messages_updated_user_uuid',
        'messages_updated_user_username'
    ];
}
