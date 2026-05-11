<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/student'));

Route::get('/student',         [StudentController::class, 'index'])->name('student.index');
Route::post('/student',        [StudentController::class, 'store'])->name('student.store');
Route::put('/student/{id}',    [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');