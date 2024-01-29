<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\TodolistService;

class TodoControllerTest extends TestCase
{
    private TodolistService $Todolistservice;

    public function setUp():void
    {
        parent::setUp();
        $this->Todolistservice = $this->app->make(TodolistService::class);
    }

    public function testShowtodo()
    {
        $this->withSession(
            [
                "keyuser" => "asep",
                "todolist" =>[
                 [
                "id" => "9",
                    "user" => "Todo"
                 ]]
                ])
        ->get("/todolist")
        ->assertSeeText("9")
        ->assertSeeText("Todo");
    }

    public function testAddtodo()
    {
        $this->withSession(["keyuser"=>"asep"])   
        ->post("/todolist",[])
        ->assertSeeText("todo is required");
    }

    public function testDelete()
    {
        $this->withSession(
            [
                "keyuser" => "asep",
                "todolist" =>[
                 [
                "id" => "9",
                    "user" => "Todo"
                 ]]
                ])
        ->get("/todolist")
        ->assertSeeText("9")
        ->assertSeeText("Todo");

        $this->Todolistservice->removetodo("9");
        
        self::assertEquals("0",sizeof($this->Todolistservice->getTodo()));

    }
}
