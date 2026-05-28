<?php

use App\Livewire\Finance\EditPayment;
use App\Livewire\Finance\ListPayments;
use App\Livewire\Sinfs\ListSinfs;
use App\Livewire\Sins\EditSinf;
use App\Livewire\Students\ListStudents;
use App\Livewire\Teacher\EditTeacher;
use App\Livewire\Teachers\ListTeachers;
use App\Livewire\User\ListUsers;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
 Route::get("/manage-users",ListUsers::class)->name('users.index');
 Route::get("/manage-student",ListStudents::class)->name("students.index");
 Route::get("manage-teachers",ListTeachers::class)->name('teachers.index');
 Route::get("manage-teachers/{record}",EditTeacher::class)->name('teachers.edit');
 Route::get("manage-sinf",ListSinfs::class)->name("sinfs.index");
 Route::get("manage-sinf/{record}",EditSinf::class)->name("sinfs.edit");
 Route::get("/finance-payment",ListPayments::class)->name("payment.index");
 Route::get("/finance-payment/{record}",EditPayment::class)->name("payment.edit");
});
require __DIR__.'/auth.php';
