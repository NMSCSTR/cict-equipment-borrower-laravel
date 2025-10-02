<?php

use App\Http\Controllers\AuthenticateUser;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [User::class, 'index'])->name('login');
Route::post('/login', [AuthenticateUser::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticateUser::class, 'destroy'])->name('logout');
Route::post('/register', [AuthenticateUser::class, 'register'])->name('register');
Route::get('/register', [AuthenticateUser::class, 'registerUser'])->name('register');
Route::get('/welcome', function () {
    return view('welcome');
})->name('auth.welcome');


// Only admins
Route::middleware('auth')->group(function () {
    Route::middleware(['userType:Admin'])->group(function () {
        Route::get('/admin/dashboard', [AuthenticateUser::class, 'adminView'])->name('admin.dashboard');
        Route::get('/admin/equipment', [EquipmentController::class, 'index'])->name('admin.equipment');
        Route::post('/admin/equipment', [EquipmentController::class, 'store'])->name('admin.equipment.store');
        Route::post('/admin/equipment/update', [EquipmentController::class, 'update'])->name('admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [EquipmentController::class, 'destroy'])->name('admin.equipment.destroy');
    });
});

//Only Instructors
Route::middleware('auth')->group(function () {
    Route::middleware(['userType:Instructor'])->group(function () {
        Route::get('/instructor/dashboard', [AuthenticateUser::class, 'instructorView'])->name('instructor.dashboard');
    });
});

//Only Students
Route::middleware('auth')->group(function () {
    Route::middleware(['userType:Student'])->group(function () {
        Route::get('/student/dashboard', [AuthenticateUser::class, 'studentView'])->name('student.dashboard');
    });
});
