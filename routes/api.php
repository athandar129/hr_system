<?php
use App\Http\Controllers\Api\EmployeeApiController;

Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn']);
Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut']);
