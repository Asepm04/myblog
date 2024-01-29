<?php 

namespace App\Services;

class Person 
{
    public $name;
    public $addres;

    var string $nme;

     public function __construct(string $nme)
     {
        $this->nme = $nme;
     }
}