<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/tasks' , [TaskController::class , "all"])->name("tasks.get");
Route::get("/task/{id}" , [TaskController::class , "show"]);
Route::post('/task' ,[TaskController::class , "store"]);
Route::put("/task/{id}", [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class ,'destroy']);