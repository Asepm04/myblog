<?php

namespace App\Services;

interface TodolistService
{
    public function Todolist(string $id,string $user):void;

    public function getTodo():array;

    public function removeTodo(string $removetodo);
}