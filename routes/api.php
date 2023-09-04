<?php

use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
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

// user routes
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'fetchAuthUser']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::resource('notebooks', NotebookController::class);
Route::resource('notes', NoteController::class);

Route::get('user/{userId}/notes', [NotebookController::class, 'getNoteBooksByUser']);

