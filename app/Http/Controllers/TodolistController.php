<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Services\TodolistService;

class TodolistController extends Controller
{
    private TodolistService $TodolistService;

    public function __construct(TodolistService $TodolistService)
    {
        $this->TodolistService = $TodolistService;
    }


   public function todolist():Response
   {
        $todo = $this->TodolistService->getTodo();

        return response()->view("user.todo",
        [
            "todolist"=>$todo
        ]);
   }

   public function addtodo(Request $request):Response|RedirectResponse
   {
        $inputtodo = $request->input('todo');

        if(empty($inputtodo))
        {
           return response()->view("user.todo",
        [
            "todolist"=>$this->TodolistService->getTodo(),
            "error"=>"todo is required"
        ]);
        
        }
         
       $this->TodolistService->Todolist(uniqid(),$inputtodo);
       return redirect()->action([TodolistController::class,"todolist"]);

    }

   public function removetodo(Request $request,$id):Response
   {
      $this->TodolistService->removetodo($id);
      return response()->view("user.todo",
    [
        "todolist"=>$this->TodolistService->getTodo(),
        "error"=>"todo berhasil diremove"
    ]);
   }
}
