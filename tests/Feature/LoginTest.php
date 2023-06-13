<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testlog()
    {
        $this->get("/login")
        ->assertSeeText("Login");

    }

    public function testsucces()
    {
        $this->post("/login",[
            "user" => "asep", "password"=>"mulyadi"
        ])->assertSessionHas("keyuser","asep");
    }

    public function testfailure()
    {
        $this->post("/login",[])
        ->assertSeeText("username and password is required");
    }

    public function testwrong()
    {
        $this->post('/login',
        [
            'user'=>"wrong",
            'password'=>"wrong"
        ])
        ->assertSeeText("username or password is wrong");
    }

    public function testlogout()
    {
        $this->post("/logout")
        ->assertRedirect("/")
        ->assertSessionMissing("keyuser");
    }

    public function testUsermiddleware()
    {
        $this->withSession(["keyuser"=>"asep"])
        ->post("/login")
        ->assertRedirect("/");
    }

    public function testMember()
    {
        $this->post("logout")
        ->assertRedirect("/");

        $this->withSession(["keyuser"=>"asep"])
        ->post("/logout")
        ->assertRedirect("/")
        ->assertSessionMissing("keyuser");
    }
}
