<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\JournalController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/', function () {
    return inertia::render('index');
})->name('home');

Route::get('/citizens', function () {
    return inertia::render('citizens/index');
})->name('citizens');

Route::resource('citizens', CitizenController::class);
Route::resource('journals', JournalController::class);
