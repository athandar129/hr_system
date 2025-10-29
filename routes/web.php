<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
return redirect()->route('login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // This line creates the missing routes: employees.index, employees.create, etc.
    Route::resource('employees', EmployeeController::class);

    // Your existing dashboard route might look like this:
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
