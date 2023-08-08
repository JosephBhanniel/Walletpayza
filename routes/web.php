<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
       // Custom logic based on the user's role
        if ($user->role === 'Superadmin') {
            // Example: Get admin-specific data from the database
            $data = 'Superadmin';
        } elseif ($user->role === 'employee') {
            // Example: Get employee-specific data from the database
            $data = 'Employee';
        }elseif ($user->role === 'company') {
            // Example: Get employee-specific data from the database
            $data = 'Company';
        }
         else {
            // Default data or fallback logic if the user role is not company,employee or admin
            $data = 'Hello, User!';
        }

        // Render the 'Dashboard' component with custom data
        return Inertia::render($data);
    })->name('dashboard');
});
