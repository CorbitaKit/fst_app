<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineJournalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
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
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', function () {
        return inertia::render('index');
    })->name('home');

    Route::resource('citizens', CitizenController::class);
    Route::resource('journals', JournalController::class);
    Route::resource('medicines', MedicineController::class);

    Route::get('medicine-journals/{citizen_id}', [MedicineJournalController::class, 'getCitizenMedicineJournal']);


    Route::post('/logout', function () {
        auth()->logout();
        $cookie = Cookie::forget('token');
        return Response::json(['message' => 'Successfully logged out'])->withCookie($cookie);
    })->name('logout');
});
