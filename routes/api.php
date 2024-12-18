<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyClientController;

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


Route::get('/clients', [MyClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [MyClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [MyClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{slug}/edit', [MyClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{slug}', [MyClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{slug}', [MyClientController::class, 'destroy'])->name('clients.destroy');