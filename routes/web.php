<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bibit\BibitController;
use App\Http\Controllers\Bibit\BibitMasukController;
use App\Http\Controllers\Bibit\BibitKeluarController;
use App\Http\Controllers\Permintaan\DibatalkanController;
use App\Http\Controllers\Permintaan\DiprosesController;
use App\Http\Controllers\Permintaan\KeluarController;
use App\Http\Controllers\User\BiodataController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\ForgotPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Permintaan\MasukController;
use App\Http\Controllers\Kegiatan\PenanamanController;
use App\Http\Controllers\Kegiatan\PembagianController;
use App\Http\Controllers\Kegiatan\LainnyaController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Login
Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login - SIPEDIBTAN']);
})->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth-authenticate');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register-page');
Route::post('/register', [AuthController::class, 'store'])->name('register-store');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::prefix('permintaan')->group(function () {
    Route::resource('masuk', MasukController::class)->names([
        'index' => 'masuk.index',
        'create' => 'masuk.create',
        'store' => 'masuk.store',
        'edit' => 'masuk.edit',
        'update' => 'masuk.update',
        'delete' => 'masuk.delete',
    ]);

    Route::resource('diproses', DiprosesController::class)->names([
        'index' => 'diproses.index',
        'create' => 'diproses.create',
        'store' => 'diproses.store',
        'edit' => 'diproses.edit',
        'update' => 'diproses.update',
        'delete' => 'diproses.delete',
    ]);
});

Route::prefix('bibit')->group(function () {
    Route::resource('bibit', BibitController::class)->names([
        'index' => 'bibit.index',
        'create' => 'bibit.create',
        'store' => 'bibit.store',
        'edit' => 'bibit.edit',
        'update' => 'bibit.update',
        'delete' => 'bibit.delete',
    ]);

    Route::resource('bibit-masuk', BibitMasukController::class)->names([
        'index' => 'bibit-masuk.index',
        'create' => 'bibit-masuk.create',
        'store' => 'bibit-masuk.store',
        'edit' => 'bibit-masuk.edit',
        'update' => 'bibit-masuk.update',
        'delete' => 'bibit-masuk.delete',
    ]);

    Route::resource('bibit-keluar', BibitKeluarController::class)->names([
        'index' => 'bibit-keluar.index',
        'create' => 'bibit-keluar.create',
        'store' => 'bibit-keluar.store',
        'edit' => 'bibit-keluar.edit',
        'update' => 'bibit-keluar.update',
        'delete' => 'bibit-keluar.delete',
    ]);
});

Route::prefix('user')->group(function () {
    Route::resource('biodata', BiodataController::class)->names([
        'index' => 'biodata.index',
        'create' => 'biodata.create',
        'store' => 'biodata.store',
        'edit' => 'biodata.edit',
        'update' => 'biodata.update',
        'delete' => 'biodata.delete',
    ]);

    Route::resource('user', UserController::class)->names([
        'index' => 'user.index',
        'create' => 'user.create',
        'store' => 'user.store',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'delete' => 'user.delete',
    ]);

});

Route::prefix('kegiatan')->group(function () {
    Route::resource('penanaman', PenanamanController::class)->names([
        'index' => 'penanaman.index',
        'create' => 'penanaman.create',
        'store' => 'penanaman.store',
        'edit' => 'penanaman.edit',
        'update' => 'penanaman.update',
        'delete' => 'penanaman.delete',
    ]);

    Route::resource('pembagian', PembagianController::class)->names([
        'index' => 'pembagian.index',
        'create' => 'pembagian.create',
        'store' => 'pembagian.store',
        'edit' => 'pembagian.edit',
        'update' => 'pembagian.update',
        'delete' => 'pembagian.delete',
    ]);

    Route::resource('lainnya', LainnyaController::class)->names([
        'index' => 'lainnya.index',
        'create' => 'lainnya.create',
        'store' => 'lainnya.store',
        'edit' => 'lainnya.edit',
        'update' => 'lainnya.update',
        'delete' => 'lainnya.delete',
    ]);

});

Route::get('/keluar', [KeluarController::class, 'index'])->name('keluar.index');
Route::post('keluar/store/{id}', [KeluarController::class, 'store'])->name('keluar.store');

Route::get('/batal', [DibatalkanController::class, 'index'])->name('batal.index');
Route::post('batal/store/{id}', [DibatalkanController::class, 'store'])->name('batal.store');
