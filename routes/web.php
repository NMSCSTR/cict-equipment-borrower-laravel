<?php

use App\Http\Controllers\AuthenticateUser;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BorrowTransactionController;
use App\Http\Controllers\ItemRequestController;
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



Route::middleware('auth')->group(function () {
    Route::middleware(['userType:Admin'])->group(function () {
        Route::get('/admin/dashboard', [AuthenticateUser::class, 'adminView'])->name('admin.dashboard');
        Route::get('/admin/equipment', [EquipmentController::class, 'index'])->name('admin.equipment');
        Route::post('/admin/equipment', [EquipmentController::class, 'store'])->name('admin.equipment.store');
        Route::post('/admin/equipment/update', [EquipmentController::class, 'update'])->name('admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [EquipmentController::class, 'destroy'])->name('admin.equipment.destroy');
        Route::get('/admin/users', [User::class, 'adminUser'])->name('admin.users');
        Route::post('admin/users', [AuthenticateUser::class, 'register'])->name('admin.user.register');
        Route::post('/admin/users/update', [User::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [User::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/admin/transaction', [BorrowTransactionController::class, 'index'])->name('admin.transaction');
        Route::post('/admin/transaction', [BorrowTransactionController::class, 'store'])->name('admin.transaction.store');
        Route::post('/admin/transaction/update', [BorrowTransactionController::class, 'update'])->name('admin.transaction.update');
        Route::delete('/admin/transaction/{id}', [BorrowTransactionController::class, 'destroy'])->name('admin.transaction.destroy');
    });

    Route::middleware(['userType:Instructor'])->group(function () {
        Route::get('/instructor/dashboard', [AuthenticateUser::class, 'instructorView'])->name('instructor.dashboard');
        Route::post('/instructor/request', [ItemRequestController::class, 'store'])->name('instructor.request.store');
        Route::post('/instructor/request/update', [ItemRequestController::class, 'update'])->name('instructor.request.update');
        Route::delete('/instructor/request/{id}', [ItemRequestController::class, 'destroy'])->name('instructor.request.destroy');
    });

    Route::middleware(['userType:Student'])->group(function () {
        Route::get('/student/dashboard', [AuthenticateUser::class, 'studentView'])->name('student.dashboard');
    });

});
