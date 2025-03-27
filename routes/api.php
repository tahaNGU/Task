<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->as('user.')->group(function(){
    Route::post('register',[UserController::class,'register'])->name('register');
    Route::post('login',[UserController::class,'login'])->name('login');
    Route::post('logout',[UserController::class,'logout'])->name('logout')->middleware("auth:sanctum");
});

Route::prefix('task/')->as('task.')->middleware('auth:sanctum')->group(function(){
    Route::post('',[TaskController::class,'create'])->name('create');
    Route::post('{id}',[TaskController::class,'update'])->name('update');
});