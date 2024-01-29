<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function testForm()
    {
        $this->view("isblad.form",
        [
            "user"=>
            [
                "premium"=>true,
                "name"=>"asep",
                "admin"=>true
            ]
        ])
        ->assertSee("checked")
        ->assertSee("asep")
        ->assertDontSee("readonly")
        ->assertSee("hidden")
        ->assertSee("_token");

        $this->view("isblad.form",
        [
            "user"=>
            [
                "premium"=>false,
                "name"=>"asep",
                "admin"=>false
            ]
        ])
        ->assertDontSeeText("checked")
        ->assertSee("asep")
        ->assertSee("readonly");
    }
}
