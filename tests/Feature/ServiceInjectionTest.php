<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Blade;
use App\Services\Person;

class ServiceInjectionTest extends TestCase
{
   public function testService()
   {
    $this->view("isblad.service-injection",["name"=>"asep"])
   ->assertSeeText("hallo asep");
   }

   public function testInlineblade()
   {
      $response = Blade::render('hello {{$name}}',['name'=>'asep']);

      self::assertEquals("hello asep",$response);
   }

   public function testExtend()
   {
      $person = new Person();
      $person->name = "asep";
      $person->addres = "city";

      $this->view("isblad.extend",['name'=>'asep','person'=>$person])
      ->assertSeeText("helloasep")
      ->assertSeeText("asep : city");

      
   }

   // public function testEcho()
   // {
   //    $person = new Person();
   //    $person->name = "asep";
   //    $person->addres = "city";

   //    $this->view("isblad.extend",['name'=>'asep','person'=>$person])
   //    ->assertSeeText("asep : city");
   // }

}
