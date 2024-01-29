<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EachTest extends TestCase
{
    public function testEach()
    {
        $this->view("isblad.eachonce",
        [
            "users"=>
            [
            "name"=>"asep",
            "hobbies"=>["coding","gaming"]
            ]
        ])->assertSeeInOrder([".red","Asep","coding","gaming"]);
    }
}
