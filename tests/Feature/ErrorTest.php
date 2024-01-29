<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ErrorTest extends TestCase
{
    public function testError()
    {
        $errors =
    [
        'name'=>"name is required",
        'password'=>"password is required"
    ];

    $this->withViewErrors($errors)->view('isblad.error',[])
    ->assertSeeText("name is required")
    ->assertSeeText("password is required");
    }
}
