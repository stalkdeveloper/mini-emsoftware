<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;
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
    return redirect()->to('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');



Route::middleware(['auth'])->group(function () {
    // Daseboard
    Route::get('/dashboard', [DashboardController::class,'dashboradDataDetails'])->name('dashboard');

    // Employee
    Route::get('/all-employee', [EmployeeController::class, 'allEmployee'])->name('getAllEmployee');
    Route::get('/create-employee', [EmployeeController::class, 'createEmployee'])->name('getCreateEmployee');
    Route::post('/store-employee', [EmployeeController::class, 'storeEmployee'])->name('getStoreEmployee');
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'viewEmployee'])->name('getEditEmployee');
    Route::get('/view-employee/{id}', [EmployeeController::class, 'viewEmployee'])->name('getViewEmployee');
    Route::post('/update-employee', [EmployeeController::class, 'updateEmployee'])->name('getUpdateEmployee');
    Route::get('/delete-employee', [EmployeeController::class, 'deleteEmployee'])->name('getDeleteEmployee');
});

require __DIR__.'/auth.php';
