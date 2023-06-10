<?php 

namespace App\Testt;

interface TestService
{
    public function login(string $user,string $password): bool;
}