<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

Route::get('/signup', function () {
    return view('login.signup');
})->name('signuppage');

Route::post('/signup', [UserController::class, 'store'])->name('signupost');


Route::get('/login', [HomeController::class, 'loginpage'])->name('loginpage');


Route::post('/login', [UserController::class, 'login'])->name('loginpost');



Route::get('/todo', [HomeController::class, 'front'])->middleware(IsUser::class)->name('mainpage');



Route::post('/addtask', [TaskController::class, 'store'])->middleware(IsUser::class)->name('addtask');

Route::post('/addcategory', [CategoryController::class, 'store'])->middleware(IsUser::class)->name('addcategory');


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('loginpage');
})->name('logout');

Route::post('/tasks/{task}/update', [TaskController::class, 'update'])->name('updatetask');

Route::delete('/task/{id}/delete', [TaskController::class, 'destroy'])->name('deletetask');

Route::delete('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('deletecategory');
