<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InherintanceTest extends TestCase
{
    public function testInheritence()
    {
        $this->view("isblad.child",[])
        ->assertSeeText("aplikasi - asepm")
        ->assertSeeText("Ini header")
        ->assertSeeText("Ini content");
    }
}
