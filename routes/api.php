<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/v1/login', [LoginController::class ,'login']);

Route::group(['middleware' => 'token'], function() {
    Route::get('/v1/todos', [ToDoController::class ,'index']);
    Route::get('/v1/todo/{id}', [ToDoController::class ,'show']);
    Route::post('/v1/todo_store', [ToDoController::class ,'store']);
    Route::put('/v1/todo_update/{id}', [ToDoController::class ,'update']);
    Route::delete('/v1/todo_delete/{id}', [ToDoController::class ,'delete']);

});



