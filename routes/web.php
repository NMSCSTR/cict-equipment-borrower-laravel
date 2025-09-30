<?php

use App\Http\Controllers\AuthenticateUser;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthenticateUser::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticateUser::class, 'destroy'])->name('logout');
Route::post('/register', [AuthenticateUser::class, 'register'])->name('register');
Route::get('/welcome', function () {
    return view('welcome');
})->name('auth.welcome');


// Route::middleware('auth')->group(functiion () {
//     Route::get()
// });


// Only admins
Route::middleware(['user.type:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Only instructors
Route::middleware(['user.type:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
});

// Only students
Route::middleware(['user.type:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});
