<?php

namespace App\Testt\Testimpl;

use App\Testt\TestService;

class TestServiceimpl implements TestService
{
    private $users = ["asep"=>"mulyadi"];
    public function login(string $user,string $password): bool
    {
        if(!isset($this->users[$user]))
        {
            return false;
        }

        $correctpaswd = $this->users[$user];
        return $password == $correctpaswd;

    }

}