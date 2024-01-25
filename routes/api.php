<?php

use App\Http\Controllers\JournalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('journals', JournalController::class);
});
