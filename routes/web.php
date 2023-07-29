<?php

use App\Http\Controllers\ToDoListController;
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

Route::get('/', [ToDoListController::class, 'index']);

Route::post('/saveItem', [ToDoListController::class, 'saveItem'])->name('saveItem');
Route::post('/markComplete/{id}', [ToDoListController::class, 'markComplete'])->name('markComplete');