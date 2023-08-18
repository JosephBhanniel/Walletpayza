<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'canDeposit' => Route::has('deposit'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Company', // Adjust the role name(s) as needed
])->group(function () {
    Route::get('/Company', [CompanyController::class, 'index'])->name('dashboard');
    Route::put('/deposit', [CompanyController::class, 'deposit'])->name('deposit');
    Route::put('/send', [CompanyController::class, 'transferToEmployee'])->name('send');
    // Add more admin-specific routes here
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Employee', // Adjust the role name(s) as needed
])->group(function () {
    Route::get('/Employee', [EmployeeController::class, 'index'])->name('dashboard');
    // Add more admin-specific routes here
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Admin', // Adjust the role name(s) as needed
])->group(function () {
    Route::get('/Admin', [SuperAdminController::class, 'index'])->name('dashboard');
    // Add more admin-specific routes here
});


