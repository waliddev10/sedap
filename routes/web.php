<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalenderPenugasanController;
use App\Http\Controllers\KontakPegawaiController;
use App\Http\Controllers\Master\BidangController;
use App\Http\Controllers\Master\JabatanTimController;
use App\Http\Controllers\Master\JenisPenugasanController;
use App\Http\Controllers\Master\KategoriArsipController;
use App\Http\Controllers\Master\KategoriPenugasanController;
use App\Http\Controllers\Master\PangkatController;
use App\Http\Controllers\Master\SkpdController;
use App\Http\Controllers\Master\TanggalLiburController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\RiwayatPenugasanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPenugasanController;
use Illuminate\Support\Facades\Artisan;
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

// setup

// Route::get('/migrate', function () {
//     return Artisan::call('migrate');
// });
// Route::get('/migrate/fresh', function () {
//     return Artisan::call('migrate:fresh');
// });
// Route::get('/seed', function () {
//     return Artisan::call('db:seed');
// });
// Route::get('/symlink', function () {
//     $target =  env('SYMLINK_PATH');
//     $shortcut = env('SYMLINK_PATH_TARGET');
//     return symlink($target, $shortcut);
// });

// router

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/dashboard', DashboardController::class)->only('index');
    Route::get('/dashboard/download/{arsip_id}', [DashboardController::class, 'download'])->name('dashboard.download');

    Route::resource('/arsip', ArsipController::class);
    Route::get('/arsip/download/{arsip_id}', [ArsipController::class, 'download'])->name('arsip.download');

    Route::get('/profil_pegawai', [KontakPegawaiController::class, 'index'])->name('profil_pegawai.index');

    // Route::get('/kalender_penugasan', [KalenderPenugasanController::class, 'index'])->name('kalender_penugasan.index');

    // Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');

    // Route::get('/riwayat_penugasan', [RiwayatPenugasanController::class, 'index'])->name('riwayat_penugasan.index');

    Route::resource('/user', UserController::class)->middleware('role:admin')->except('show');

    Route::resource('/penugasan', PenugasanController::class)->middleware('role:admin');
    Route::resource('/user_penugasan', UserPenugasanController::class)->middleware('role:admin')->except(['index', 'show', 'create', 'edit']);

    Route::prefix('/master')->middleware('role:admin')->group(function () {
        Route::resource('/bidang', BidangController::class)->except('show');
        // Route::resource('/skpd', SkpdController::class)->except('show');
        // Route::resource('/tanggal_libur', TanggalLiburController::class)->except('show');
        Route::resource('/pangkat', PangkatController::class)->except('show');
        Route::resource('/kategori_arsip', KategoriArsipController::class)->except('show');
        // Route::resource('/jenis_penugasan', JenisPenugasanController::class)->except('show');
        // Route::resource('/kategori_penugasan', KategoriPenugasanController::class)->except('show');
        // Route::resource('/jabatan_tim', JabatanTimController::class)->except('show');
    });

    // Route::prefix('/laporan_harian')->group(function () {
    //     Route::get('/', [LaporanHarianController::class, 'index'])
    //         ->name('laporan_harian.index');
    //     Route::get('/payment_point/{payment_point}', [LaporanHarianController::class, 'show'])
    //         ->name('laporan_harian.show');
    //     Route::get('/payment_point/{payment_point}/{jenis_pkb}/create', [LaporanHarianController::class, 'create'])
    //         ->name('laporan_harian.create');
    //     Route::post('/payment_point/{payment_point}', [LaporanHarianController::class, 'store'])
    //         ->name('laporan_harian.store');
    //     Route::get('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'edit'])
    //         ->name('laporan_harian.edit');
    //     Route::put('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'update'])
    //         ->name('laporan_harian.update');
    //     Route::delete('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'destroy'])
    //         ->name('laporan_harian.destroy');
    // });

    // Route::prefix('/laporan_harian_skpd_batal')->group(function () {
    //     Route::get('/', [LaporanHarianSkpdBatalController::class, 'index'])
    //         ->name('laporan_harian_skpd_batal.index');
    //     Route::get('/payment_point/{payment_point}', [LaporanHarianSkpdBatalController::class, 'show'])
    //         ->name('laporan_harian_skpd_batal.show');
    //     Route::get('/payment_point/{payment_point}/{esamsat}', [LaporanHarianSkpdBatalController::class, 'edit'])
    //         ->name('laporan_harian_skpd_batal.edit');
    //     Route::put('/payment_point/{payment_point}/{esamsat}', [LaporanHarianSkpdBatalController::class, 'update'])
    //         ->name('laporan_harian_skpd_batal.update');
    // });

    // Route::prefix('/laporan_bulanan_esamsat')->group(function () {
    //     Route::get('/', [LaporanBulananEsamsatController::class, 'index'])
    //         ->name('laporan_bulanan_esamsat.index');
    //     Route::post('/print', [LaporanBulananEsamsatController::class, 'print'])
    //         ->name('laporan_bulanan_esamsat.print');
    // });


    // Route::prefix('/laporan_bulanan_penerimaan')->group(function () {
    //     Route::get('/', [LaporanBulananPenerimaanController::class, 'index'])
    //         ->name('laporan_bulanan_penerimaan.index');
    //     Route::post('/print', [LaporanBulananPenerimaanController::class, 'print'])
    //         ->name('laporan_bulanan_penerimaan.print');
    // });

    // Route::prefix('/laporan_bulanan_skpd')->group(function () {
    //     Route::get('/', [LaporanBulananSkpdController::class, 'index'])
    //         ->name('laporan_bulanan_skpd.index');
    //     Route::post('/print', [LaporanBulananSkpdController::class, 'print'])
    //         ->name('laporan_bulanan_skpd.print');
    // });

    // Route::prefix('/laporan_bulanan_skpd_batal')->group(function () {
    //     Route::get('/', [LaporanBulananSkpdBatalController::class, 'index'])
    //         ->name('laporan_bulanan_skpd_batal.index');
    //     Route::post('/print', [LaporanBulananSkpdBatalController::class, 'print'])
    //         ->name('laporan_bulanan_skpd_batal.print');
    // });
});

require __DIR__ . '/auth.php';
