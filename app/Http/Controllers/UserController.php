<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Testt\TestService;

class UserController extends Controller
{
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function login():Response
    {
      return  response()->view("user.login",["title"=>"Login"]);
    }

    public function Dologin(Request $request) :Response|RedirectResponse
    {
       $user = $request->input('user');
       $password = $request->input('password');

        if(empty($user)||empty($password))
        {
            return response()->view("user.login",
            [
                "title"=>"Login",
                "error"=>"username and password is required"
            ]);
        }
        if($this->testService->login($user,$password))
        {
          $request->session()->put("keyuser",$user);
          return redirect("/");
        }
            return response()->view("user.login",
            [
                "title"=>"Login",
                "error"=>"username or password is wrong"
            ]);
    }

    public function Dologout(Request $request): RedirectResponse
    {
        $request->session()->forget("keyuser");
        return redirect("/");
    }
}
