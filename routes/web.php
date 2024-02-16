<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineJournalController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubGoalController;
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
})->name('login');


Route::post('/login', [LoginController::class, 'login']);




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', function () {
        return inertia::render('index');
    })->name('home');

    Route::resource('citizens', CitizenController::class);
    Route::resource('journals', JournalController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('goals', GoalController::class);
    Route::resource('sub_goals', SubGoalController::class);
    Route::resource('apps', AppController::class);

    Route::group(['prefix' => 'journals'], function () {
        Route::get('/get-citizen-journal/{citizen_id}', [JournalController::class, 'getCitizenJournal']);
    });

    Route::group(['prefix' => 'medicines'], function () {
        Route::get('/get-citizen-medicines/{citizen_id}', [MedicineController::class, 'getCitizenMedicines']);
    });

    Route::group(['prefix' => 'plans'], function () {
        Route::get('/get-citizen-plans-and-goals/{citizen_id}', [PlanController::class, 'getCitizenPlansAndGoals']);
        Route::get('/get-plan-goals/{plan_id}', [PlanController::class, 'getGoalsOfPlan']);
    });
    Route::patch('sub_goals/mark-as-complete/{id}', [SubGoalController::class, 'markAsComplete']);

    Route::get('medicine-journals/{citizen_id}', [MedicineJournalController::class, 'getCitizenMedicineJournal']);

    Route::group(['prefix' => 'logs'], function () {
        Route::get('/journal/{journal_id}', [LogController::class, 'getJournalLogs']);
        Route::get('/medicine', [LogController::class, 'getMedicineLogs']);
    });


    Route::post('/logout', function () {
        auth()->logout();
        $cookie = Cookie::forget('token');
        return Response::json(['message' => 'Successfully logged out'])->withCookie($cookie);
    })->name('logout');
});
