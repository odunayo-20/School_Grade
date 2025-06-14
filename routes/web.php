<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ResultTableController;
use App\Http\Controllers\MarkRegisterController;

Route::middleware(['guest'])->group( function (){




Route::get('/', [AuthController::class, 'login'])->name('admin.login');
Route::get('/forget', [AuthController::class, 'forget'])->name('admin.forget');
Route::post('/forget/send', [AuthController::class, 'forgetSend'])->name('admin.forgetSend');
Route::get('/reset-password/{token}/{email}', [AuthController::class, 'resetPassword'])->name('admin.resetPassword');
Route::post('/reset/password/change', [AuthController::class, 'resetPasswordChange'])->name('admin.resetPasswordChange');
Route::post('admin/login/confirm', [AuthController::class, 'loginConfirm'])->name('admin.loginConfirm');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/edit/{id}', [AdminController::class, 'profileEdit'])->name('admin.profile.edit');

Route::get('/student', [StudentController::class, 'index'])->name('admin.student');
Route::get('/student/create', [StudentController::class, 'create'])->name('admin.student.create');
Route::post('/student/create', [StudentController::class, 'store'])->name('admin.student.store');
Route::get('/student/edit/{student}', [StudentController::class, 'edit'])->name('admin.student.edit');
Route::post('/student/edit/{student}', [StudentController::class, 'update'])->name('admin.student.update');
Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('admin.student.delete');

Route::get('/result', [ResultController::class, 'index'])->name('admin.result');
Route::get('/result/create', [ResultController::class, 'create'])->name('admin.result.create');
Route::post('/result/create', [ResultController::class, 'store'])->name('admin.result.store');
Route::get('/result/edit/{result}', [ResultController::class, 'edit'])->name('admin.result.edit');
Route::post('/result/edit/{result}', [ResultController::class, 'update'])->name('admin.result.update');
Route::delete('/result/{result}', [ResultController::class, 'destroy'])->name('admin.result.delete');

Route::get('/mark-result', [MarkRegisterController::class, 'index'])->name('admin.markResult');
Route::get('/mark-result/create', [MarkRegisterController::class, 'create'])->name('admin.markResult.create');
Route::post('/mark-result/create', [MarkRegisterController::class, 'store'])->name('admin.markResult.store');
Route::get('/mark-result/edit/{result}', [MarkRegisterController::class, 'edit'])->name('admin.markResult.edit');
Route::post('/mark-result/edit/{result}', [MarkRegisterController::class, 'update'])->name('admin.markResult.update');
Route::delete('/mark-result/{result}', [MarkRegisterController::class, 'destroy'])->name('admin.markResult.delete');
Route::get('/mark-result/view', [MarkRegisterController::class, 'result_view'])->name('admin.markResult.result_view');
Route::get('/affective', [MarkRegisterController::class, 'affective'])->name('admin.markResult.affective');
Route::get('/pyschomotor', [MarkRegisterController::class, 'pyschomotor'])->name('admin.markResult.pyschomotor');
Route::get('/attendance', [MarkRegisterController::class, 'attendance'])->name('admin.markResult.attendance');

// Route::get('result-table', App\Livewire\Admin\ResultsTable::class)->name('admin.result-table');
Route::get('subject', App\Livewire\Admin\Subject\Index::class)->name('admin.subject');
Route::get('resumption', App\Livewire\Admin\Resumption\Index::class)->name('admin.resumption');
Route::get('class', App\Livewire\Admin\Class\Index::class)->name('admin.class');
Route::get('semester', App\Livewire\Admin\Semester\Index::class)->name('admin.semester');
Route::get('session', App\Livewire\Admin\Sessions\Index::class)->name('admin.session');
Route::get('total_attendances', App\Livewire\Admin\TotalAttendances\Index::class)->name('admin.total_attendances');

Route::get('result-table', [ResultTableController::class, 'index'])->name('admin.result-table');
// Route::get('subject', [SubjectController::class, 'index'])->name('admin.subject');

});

// Route::get('/product', [ProductController::class, 'removeImage'])->name('admin.product.delete.image');
