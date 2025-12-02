<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HafalanController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PelajaranController;
use App\Http\Controllers\Admin\SantriController;
use App\Http\Controllers\Admin\UstadzController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Ustadz\Berandaustadz;
use App\Http\Livewire\Ustadz\Hafalan;
use App\Http\Livewire\Ustadz\Jadwal;
use App\Http\Livewire\Ustadz\Santri;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('ustadz', UstadzController::class);
    Route::resource('santri', SantriController::class);
    Route::resource('hafalan', HafalanController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('laporan', LaporanController::class);
    Route::resource('jadwal', JadwalController::class);

      // ✅ Tambahin route export biar gak error
    Route::get('/export/excel', [DashboardController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [DashboardController::class, 'exportPdf'])->name('export.pdf');

});

Route::prefix('ustadz')
->middleware(['auth', 'role:ustadz'])
->group(function() {
 Route::get('/dashboard', Berandaustadz::class)->name('dashboardustadz');

    Route::get('/jadwal', Jadwal::class)->name('ustadz.jadwal');

    Route::get('/santri', Santri::class)->name('ustadz.santri');

    Route::get('/hafalan', Hafalan::class)->name('ustadz.hafalan');

    Route::get('/laporan', \App\Http\Livewire\Ustadz\Laporan::class)->name('ustadz.laporan');

    Route::get('/assign-data-ustadz', function () {
    $ustadzId = 1; // Ganti dengan ID ustadz yang ingin diassign

    // 1️⃣ Assign semua santri ke ustadz
    Santri::query()->update(['ustadz_id' => $ustadzId]);

    // 2️⃣ Assign semua jadwal ke ustadz
    Jadwal::query()->update(['ustadz_id' => $ustadzId]);

    // 3️⃣ Assign semua hafalan ke ustadz
    Hafalan::query()->update(['ustadz_id' => $ustadzId]);

    return "Semua data sudah diassign ke ustadz ID $ustadzId";
    });
}
);
