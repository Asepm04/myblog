<?php 

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function Todolist(string $id ,string $user):void 
    {
        if(!session()->exists("todolist"))
        {
            Session::put("todolist",[]);
        }

        Session::push("todolist",
        [
            "id" => $id,
            "user" => $user
        ]);
    } 

    public function getTodo():array
    {
        return Session::get("todolist",[]);
    }

    public function removeTodo(string $removetodo)
    {
        $todolist = Session::get("todolist");
        foreach($todolist as $index => $value)
        {
            if($value["id"]==$removetodo)
            {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put("todolist",$todolist);
    }

   
}