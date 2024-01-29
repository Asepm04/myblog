<?php

namespace App\Services;

class Sinjection 
{
    public function Sayhello(string $name):string
    {
        return "hallo $name";
    }
}