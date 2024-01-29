<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;


class TodolistTest extends TestCase
{
    private TodolistService $Todolistservice;

    public function setUp():void
    {
        parent::setUp();
        $this->Todolistservice = $this->app->make(TodolistService::class);
    }

    public function testServiceTodo()
    {
        self::assertNotNull($this->Todolistservice);
    }

    public function testSavetodo()
    {
         $this->Todolistservice->Todolist("1","asep");
         $todo = Session::get("todolist");
        foreach($todo as $value)
        {
            self::assertEquals("1",$value["id"]);
            self::assertEquals("asep",$value["user"]);
        }

    }

    public function testGetTodo()
    {
        $expected = [
            [
                "id" => "1",
                "user" => "asep"
            ],
            [
                "id"=>"2",
                "user"=>"mul"
            ]
            ];

            $this->Todolistservice->Todolist("1","asep");
            $this->Todolistservice->Todolist("2","mul");

            self::assertEquals($expected,$this->Todolistservice->getTodo());
    }

    public function testRemovetodo()
    {
        $this->Todolistservice->Todolist("1","asep");
        $this->Todolistservice->Todolist("2","mul");

        self::assertEquals("2",sizeof($this->Todolistservice->getTodo()));

        $this->Todolistservice->removeTodo("3");
        self::assertEquals("2",sizeof($this->Todolistservice->getTodo()));
        $this->Todolistservice->removeTodo("2");
        self::assertEquals("1",sizeof($this->Todolistservice->getTodo()));
        $this->Todolistservice->removeTodo("1");
        self::assertEquals("0",sizeof($this->Todolistservice->getTodo()));

    }
   
}
