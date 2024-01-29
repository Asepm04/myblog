<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Homepagetest extends TestCase
{
    public function testHomepage()
    {
        $this->post("/")
        ->assertRedirect("/login");

        $this->withSession(["keyuser"=>"asep"])
        ->post("/")->assertRedirect("todolist");
    }
}
