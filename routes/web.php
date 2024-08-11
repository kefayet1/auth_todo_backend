<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//User
Route::post("/user-registration", [UserController::class, "userRegistration"]);
Route::post("/user-login", [UserController::class, "userLogin"]);

//Todos
Route::post("/todo-list",[TodoController::class,"todoList"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-create",[TodoController::class,"todoCreate"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-title-update",[TodoController::class,"todoTitleUpdate"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-completed-update",[TodoController::class,"todoCompletedUpdate"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-color-update",[TodoController::class,"todoColorUpdate"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-delete",[TodoController::class,"todoDelete"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-clear-completed",[TodoController::class,"todoClearCompleted"])->middleware([TokenVerificationMiddleware::class]);
Route::post("/todo-all-complete",[TodoController::class,"todoAllComplete"])->middleware([TokenVerificationMiddleware::class]);

