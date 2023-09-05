<?php

use App\Http\Controllers\API\V1\NotebookController;
use App\Http\Controllers\API\V1\NoteController;
use App\Http\Controllers\API\V1\UserController;
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

Route::prefix('v1')->group(function () {
    
    // Public routes
    Route::post('/login', [UserController::class, 'login']);

    // Routes that require authentication
    Route::middleware('auth:sanctum')->group(function () {
        
        // User-related routes
        Route::get('/user', [UserController::class, 'fetchAuthUser']);
        Route::post('/logout', [UserController::class, 'logout']);

        // Get all notebooks of authenticated user
        Route::get('/usernotebooks', [NotebookController::class, 'getNoteBooksByUser']);

        // CRUD operations for notebooks
        Route::resource('notebooks', NotebookController::class);

        // Get all notes of a specific notebook
        Route::get('notebooks/{notebook}/notes', [NoteController::class, 'getNotesByNotebook']);

        // CRUD operations for notes
        Route::resource('notes', NoteController::class);

    });
});
