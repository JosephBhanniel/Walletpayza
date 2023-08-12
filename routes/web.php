<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         $user = auth()->user();
//         $options = [];
//        // Custom logic based on the user's role
//         if ($user->role === 'Superadmin') {
//             // Example: Get admin-specific data from the database
//             $data = 'Superadmin';
//             $options = [
//                 "id" => $user->id,
//                 "name" => $user->name
//             ];
            
//         } elseif ($user->role === 'Employee') {
//             // Example: Get employee-specific data from the database
//             $data = 'Employee';
//             $options = [
//                 "id" => $user->id,
//                 "name" => $user->name
//             ];
//         }elseif ($user->role === 'Company') {
//             // Example: Get employee-specific data from the database
//             $data = 'Company';
//             $options = [
//                 "id" => $user->id,
//                 "name" => $user->name
//             ];
//         }
//          else {
//             // Default data or fallback logic if the user role is not company,employee or admin
//             $data = 'Hello, User!';
//         }

//         // Render the 'Dashboard' component with custom data
//         return Inertia::render($data, $options);
//     })->name('dashboard');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/Company', [CompanyController::class, 'index'])->name('dashboard');
    Route::get('/Employee', [EmployeeController::class, 'index'])->name('dashboard');

});
Route::put('/deposit', [CompanyController::class, 'deposit'])->name('deposit');
Route::put('/send', [CompanyController::class, 'transferToEmployee'])->name('send');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//           Route::get('/Company', [CompanyController::class, 'index'])->name('dashboard');
//           Route::get('/Employee', [EmployeeController::class, 'index'])->name('dashboard');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//           Route::get('/Employee', [EmployeeController::class, 'index'])->name('dashboard');
// });

