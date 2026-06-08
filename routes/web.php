<?php

use App\Livewire\Admins\CreateAdmin;
use App\Livewire\Admins\EditAdmin;
use App\Livewire\Admins\ListAdmin;
use App\Livewire\Company\CreateCompany;
use App\Livewire\Company\EditCompany;
use App\Livewire\Company\ListCompany;
use App\Livewire\Finance\CreatePayment;
use App\Livewire\Finance\EditPayment;
use App\Livewire\Finance\ListPayments;
use App\Livewire\Jobs\CreateJob;
use App\Livewire\Jobs\CreateJobDateils;
use App\Livewire\Jobs\EditJob;
use App\Livewire\Jobs\EditJobDetails;
use App\Livewire\Jobs\ListJobs;
use App\Livewire\Jobs\ListJobsDateils;
use App\Livewire\Sinfs\ListSinfs;
use App\Livewire\Sins\EditSinf;
use App\Livewire\Students\ListStudents;
// use App\Livewire\Teacher\EditTeacher;
use App\Livewire\Teachers\CreateTeacher;
use App\Livewire\Teachers\EditTeacher;
// use App\Livewire\Teachers\EditTeacher;
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
//  Route::get("/manage-users",ListUsers::class)->name('users.index');
 Route::get("/manage-admin",ListAdmin::class)->name('admins.index');
 Route::get("/admin-create",CreateAdmin::class)->name('admins.create');
 Route::get("/manage-job",ListJobs::class)->name('jobs.index');
 Route::get("/job-create",CreateJob::class)->name('jobs.create');
 Route::get("/teacher-create",CreateTeacher::class)->name('teacher.create');
 Route::get("/jobDateils-create",CreateJobDateils::class)->name('jobDateils.create');
 Route::get("/manage-job-datiels",ListJobsDateils::class)->name('job_dateils.index');
 Route::get("/manage-company",ListCompany::class)->name('company.index');
 Route::get("/create-company",CreateCompany::class)->name('company.create');
  Route::get("manage-admin/{record}",EditAdmin::class)->name("admins.edit");
  Route::get("manage-job/{record}",EditJob::class)->name("jobs.edit");
  Route::get("manage-company/{record}",EditCompany::class)->name("company.edit");
  Route::get("manage-job-datiels/{record}",EditJobDetails::class)->name("jobDetails.edit");
//  Route::get("/manage-student",ListStudents::class)->name("students.index");
 Route::get("manage-teachers",ListTeachers::class)->name('teachers.index');
 Route::get("manage-teachers/{record}",EditTeacher::class)->name('teachers.edit');
 Route::get("manage-sinf",ListSinfs::class)->name("sinfs.index");
//  Route::get("manage-sinf/{record}",EditSinf::class)->name("sinfs.edit");
//  Route::get("/finance-payment",ListPayments::class)->name("payment.index");
 Route::get("/finance-payment",CreatePayment::class)->name("payment.create");
//  Route::get("/finance-payment/{record}",EditPayment::class)->name("payment.edit");
});
require __DIR__.'/auth.php';
