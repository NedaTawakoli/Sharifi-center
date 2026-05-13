<?php

use App\Livewire\Sinfs\ListSinfs;
use App\Livewire\Students\ListStudents;
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
 Route::get("manage-sinf",ListSinfs::class)->name("sinfs.index");
});
require __DIR__.'/auth.php';
