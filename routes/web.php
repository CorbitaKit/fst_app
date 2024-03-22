<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineJournalController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionUserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubGoalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
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
})->name('login_page');


Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('password-change', function () {
    return Inertia::render('auth/changepassword');
})->name('change-password');

Route::patch('users/password-change', [UserController::class, 'updatePassword']);

Route::resource('companies', CompanyController::class);

Route::middleware(['web', 'force.password.change'])->group(function () {
    Route::get('/home', function () {
        return inertia::render('index', ['employee_id' => Auth::user()->id]);
    })->name('home');
    Route::get('citizens/get-citizens', [CitizenController::class, 'getCitizens']);
    Route::resource('citizens', CitizenController::class);
    Route::resource('journals', JournalController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('goals', GoalController::class);
    Route::resource('sub_goals', SubGoalController::class);
    Route::resource('apps', AppController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('folders', FolderController::class);

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('schedules', ScheduleController::class);

    Route::resource('protocols', ProtocolController::class);

    Route::group(['prefix' => 'journals'], function () {
        Route::get('/get-citizen-journal/{citizen_id}', [JournalController::class, 'getCitizenJournal']);
        Route::get('/get-sorted-journals/{citizen_id}/{sort}', [JournalController::class, 'getSortedJournal']);
        Route::get('/get-filtered-journal/{citizen_id}/{field}', [JournalController::class, 'getFilteredJournal']);
    });

    Route::group(['prefix' => 'medicines'], function () {
        Route::get('/get-citizen-medicines/{citizen_id}', [MedicineController::class, 'getCitizenMedicines']);
    });

    Route::group(['prefix' => 'plans'], function () {
        Route::get('/get-citizen-plans-and-goals/{citizen_id}', [PlanController::class, 'getCitizenPlansAndGoals']);
        Route::get('/get-plan-goals/{plan_id}', [PlanController::class, 'getGoalsOfPlan']);
    });
    Route::patch('sub_goals/mark-as-complete/{id}', [SubGoalController::class, 'markAsComplete']);
    Route::patch('goals/mark-as-complete/{id}', [GoalController::class, 'markAsComplete']);

    Route::get('goals/get-sub-goals/{id}', [GoalController::class, 'getSubGoals']);

    Route::get('medicine-journals/{citizen_id}', [MedicineJournalController::class, 'getCitizenMedicineJournal']);

    Route::group(['prefix' => 'logs'], function () {
        Route::get('/journal/{journal_id}', [LogController::class, 'getJournalLogs']);
        Route::get('/medicine', [LogController::class, 'getMedicineLogs']);
    });

    Route::get('documents/get-citizen-documents/{citizen_id}', [DocumentController::class, 'getCitizenDocument']);
    Route::get('documents/get-document-children/{parent_id}', [DocumentController::class, 'getDocumentChildren']);
    Route::get('documents/get-file-size/{citizen_id}', [DocumentController::class, 'getFileSize']);
    Route::get('users/get-company-users/{company_id}', [UserController::class, 'getUsersInCompany']);

    Route::get('schedules/get-employee-schedule/{employee_id}', [ScheduleController::class, 'getEmployeeSchedule']);
    Route::get('schedules/get-schedules', [ScheduleController::class, 'show']);

    Route::get('permissions/{user_id}', PermissionController::class);

    Route::post('permission-users', [PermissionUserController::class, 'store']);

    Route::delete('permission-users/{permission_id}/{user_id}', [PermissionUserController::class, 'destroy']);
    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $cookie = Cookie::forget('token');
        return redirect()->route('login_page');
    })->name('logout');
});
