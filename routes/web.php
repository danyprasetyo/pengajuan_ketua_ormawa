<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\Admin\OrmawaController;
use App\Http\Controllers\Admin\BuatAkunController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\KelolaPengajuanController;
use App\Http\Controllers\Admin\HistoriPengajuanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\PersyaratanPendaftaranController;
use App\Http\Controllers\User\PersyaratanController;

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
    return view('welcome');
});
Route::middleware('revalidate')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/authenticate', 'authenticate')->name('authenticate');
        });
        Route::controller(RegisterController::class)->group(function () {
            Route::get('/register', 'register')->name('register');
            Route::post('/registration', 'registration')->name('registration');
        });
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('/forgot-password', 'forgotPassword')->name('forgot_password');
            Route::post('/forgotPasswordProcess', 'forgotPasswordProses')->name('forgot_password_proses');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('/reset-password/{token}', 'resetPassword')->name('resetPassword');
            Route::post('/reset-password', 'resetPasswordProcess')->name('resetPasswordProcess');
        });
    });
    Route::middleware('auth')->group(function () {
        Route::controller(LogoutController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
        });
        Route::name('dashboard.')->group(function () {
            Route::prefix('/dashboard')->group(function () {
                Route::controller(DashboardController::class)->group(function () {
                    Route::get('', 'index')->name('');
                });
                Route::middleware('admin')->group(function () {
                    Route::controller(PeriodeController::class)->group(function () {
                        Route::get('/periode', 'index')->name('periode.index');
                        Route::post('/periode', 'store')->name('periode.store');
                        Route::patch('/periode/{id}', 'update')->name('periode.update');
                        Route::get('/periode/{id}', 'show')->name('periode.show');
                    });
                    Route::resource('buat_akun', BuatAkunController::class);
                    Route::resource('ormawa', OrmawaController::class)->only('index', 'show');
                    Route::resource('persyaratan', PersyaratanPendaftaranController::class)->only('index', 'store', 'destroy');
                    Route::controller(KelolaPengajuanController::class)->group(function () {
                        Route::get('/pengajuan/pending', 'pending')->name('pengajuan.pending');
                        Route::get('/pengajuan/ditolak', 'ditolak')->name('pengajuan.ditolak');
                        Route::get('/pengajuan/diterima', 'diterima')->name('pengajuan.diterima');
                        Route::patch('/pengajuan/konfirmasi', 'konfirmasi')->name('pengajuan.konfirmasi');
                        Route::get('/pengajuan/{id}', 'show')->name('pengajuan.show');
                        Route::post('/pengajuan/print', 'print')->name('pengajuan.print');
                    });
                    // Route::controller(HistoriPengajuanController::class)->group(function () {
                    //     Route::get('/pengajuan/pending', 'pending')->name('pengajuan.pending');
                    // });
                });
                Route::middleware(['user', 'akun_aktif'])->group(function () {
                    Route::resource('pengajuan', PengajuanController::class)->only('index','store','edit','update');
                    Route::controller(PersyaratanController::class)->group(function () {
                        Route::patch('/persyaratan/setuju', 'persyaratan')->name('persyaratan.setuju');
                    });
                });
            });
            // Route::controller(UserSettingsController::class)->group(function () {
            //     Route::prefix('dashboard/user')->group(function () {
            //         Route::name('dashboard.user.')->group(function () {
            //             Route::get('/settings', 'index')->name('settings');
            //         });
            //     });
            // });
        });
    });
});
