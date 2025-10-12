<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AdminController; // Assuming AdminController is in the default location
use App\Http\Controllers\ProfileController; // Assuming ProfileController is in the default location

Route::get('/', function () {
    return view('welcome');
});

// 1. ADMIN DASHBOARD & HR MANAGEMENT GROUP
// This block requires the user to be logged in (auth) AND flagged as an admin.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Main Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // HR Management Resources (CRUD operations for admin)
    //Route::resource('employees', EmployeeController::class);
    //Route::resource('departments', DepartmentController::class);
}); // <-- The missing closing brace for the admin group is now here!

// 2. STANDARD AUTHENTICATED USER ROUTES
// This block only requires the user to be logged in (auth).
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::resource('employees', EmployeeController::class);//define all CRUD routes (index, create, store, etc.)



Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
