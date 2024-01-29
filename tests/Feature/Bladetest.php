<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Bladetest extends TestCase
{ 
     
    //  public function testUnless()
    // {
    //     $this->view("isblad.unless",["isadmin"=>true])
    //     ->assertDontSeeText("you are note admin");

    //     $this->view("isblad.unless",["isadmin"=>false])
    //     ->assertSeeText("you are note admin");
    // }

    // public function testEnv()
    // {
    //     $this->view("isblad.unless",["isadmin"=>false])
    //     ->assertSeeText("this is test environment");
    // }

    // public function testSwitch()
    // {
    //     $this->view("isblad.unless",["isadmin"=>false,"nilai"=>"A"])
    //     ->assertSeeText("Memuaskan");

    //     $this->view("isblad.unless",["isadmin"=>false,"nilai"=>"B"])
    //     ->assertSeeText("Baik");

    //     $this->view("isblad.unless",["isadmin"=>false,"nilai"=>""])
    //     ->assertSeeText("tidak lulus");

    // }
    
    // public function testForelse()
    // {
    //     $this->view("isblad.forloop",["hobby"=>[]])
    //     ->assertSeeText("tidak ada data");

    //     $this->view("isblad.forloop",["hobby"=>["coding","statiska"]])
    //     ->assertSeeText("coding")
    //     ->assertSeeText("statiska");
    // }
   public function testForelse()
    {
        $this->view("isblad.forloop",["hobby"=>[]])
        ->assertSeeText("tidak ada data");

        $this->view("isblad.forloop",["hobby"=>["coding","statiska"]])
        ->assertSeeText("coding")
        ->assertSeeText("statiska");
    }
}
