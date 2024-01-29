<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[App\Http\Controllers\HomeController::class,"home"]);

Route::view("/template","template");

Route::controller(App\Http\Controllers\UserController::class)->group(function()
{
    Route::get("/login","login")->middleware([App\Http\Middleware\OnlyuserMiddle::class]);
    Route::post("/login","Dologin")->middleware([App\Http\Middleware\OnlyuserMiddle::class]);
    Route::post("/logout","Dologout")->middleware([App\Http\Middleware\Onlymembermiddle::class]);
});

Route::controller(App\Http\Controllers\TodolistController::class)
->middleware(App\Http\Middleware\Onlymembermiddle::class)->group(function()
{
    Route::get("/todolist","todolist");
    Route::post("todolist","addtodo");
    Route::post("/remove/{id}/delete","removetodo");
});


Route::view("/error","isblad.error",[]);