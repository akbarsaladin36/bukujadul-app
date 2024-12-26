<?php

namespace App\Repositories\Profile;

interface ProfileRepositoryInterface
{
    public function GetOne($username);
    public function Update($username, array $data);
}