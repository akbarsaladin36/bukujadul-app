<?php

use App\Helper\Helper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_uuid = Helper::GenerateUuid();
        $data = [
            [
                'user_uuid' => $user_uuid,
                'user_username' => 'admin',
                'user_email' => 'admin@test.com',
                'user_password' => Helper::HashPassword('admin'),
                'user_status_cd' => 'active',
                'user_role' => 'admin',
                'created_user_date' => Helper::GetDatetime(),
                'created_user_uuid' => $user_uuid,
                'created_user_username' => 'admin'
            ]
        ];
        return DB::table('bj_users')->insert($data);
    }
}
