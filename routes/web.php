<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\CutisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\RekrutmenController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');


// Auth::routes();

Auth::routes([
    'register' => false,
]);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', isAdmin::class]], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route Jabatan
    // Route::resource('jabatan', JabatanController::class);s
    //Route Jabatan Tanpa Resource
    Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::post('jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('jabatan/{id}', [JabatanController::class, 'show'])->name('jabatan.show');
    Route::get('jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::delete('jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

    // Route pegawai
    // Route::resource('pegawai', PegawaiConteroller::class);
    // Route pegawai Tanpa Resource
    Route::get('pegawai/akun', [PegawaiController::class, 'indexAdmin'])->name('pegawai.admin');
    Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('pegawai/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
    Route::get('pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    //Route Penggajian
    // Route::resource('penggajian', PenggajianController::class);
    // Route Penggajian Tanpa Resource
    Route::get('penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
    Route::get('penggajian/create', [PenggajianController::class, 'create'])->name('penggajian.create');
    Route::post('penggajian', [PenggajianController::class, 'store'])->name('penggajian.store');
    Route::get('penggajian/{id}', [PenggajianController::class, 'show'])->name('penggajian.show');
    Route::get('penggajian/{id}/edit', [PenggajianController::class, 'edit'])->name('penggajian.edit');
    Route::put('penggajian/{id}', [PenggajianController::class, 'update'])->name('penggajian.update');
    Route::delete('penggajian/{id}', [PenggajianController::class, 'destroy'])->name('penggajian.destroy');

    //Route absensi
    // Route::resource('absensi', AbsensiController::class);
    // Route absensi Tanpa Resource
    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('absensi/{id}', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::get('absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

    //Route rekrutmen
    // Route::resource('rekrutmen', RekrutmenController::class);
    // Route rekrutmen Tanpa Resource
    Route::get('rekrutmen', [RekrutmenController::class, 'index'])->name('rekrutmen.index');
    Route::get('rekrutmen/create', [RekrutmenController::class, 'create'])->name('rekrutmen.create');
    Route::post('rekrutmen', [RekrutmenController::class, 'store'])->name('rekrutmen.store');
    Route::get('rekrutmen/{id}', [RekrutmenController::class, 'show'])->name('rekrutmen.show');
    Route::get('rekrutmen/{id}/edit', [RekrutmenController::class, 'edit'])->name('rekrutmen.edit');
    Route::put('rekrutmen/{id}', [RekrutmenController::class, 'update'])->name('rekrutmen.update');
    Route::delete('rekrutmen/{id}', [RekrutmenController::class, 'destroy'])->name('rekrutmen.destroy');

    //Route cuti
    // Route::resource('cuti', CutisController::class);
    // Route cuti Tanpa Resource
    Route::get('cuti/menu', [CutisController::class, 'menu'])->name('cuti.menu');
    Route::get('cuti', [CutisController::class, 'index'])->name('cuti.index');
    Route::get('cuti/create', [CutisController::class, 'create'])->name('cuti.create');
    Route::post('cuti', [CutisController::class, 'store'])->name('cuti.store');
    Route::get('cuti/{id}', [CutisController::class, 'show'])->name('cuti.show');
    Route::get('cuti/{id}/edit', [CutisController::class, 'edit'])->name('cuti.edit');
    Route::put('cuti/{id}', [CutisController::class, 'update'])->name('cuti.update');
    Route::put('/cuti/confirm/{id}', [CutisController::class, 'confirm'])->name('cuti.confirm');
    Route::delete('cuti/{id}', [CutisController::class, 'destroy'])->name('cuti.destroy');
    Route::put('/cuti/approve/{id}', [CutisController::class, 'approve'])->name('cuti.approve');

    

    //Route berkas
    // Route::resource('berkas', BerkasController::class);
    Route::get('berkas', [BerkasController::class, 'index'])->name('berkas.index');
    Route::get('berkas/create', [BerkasController::class, 'create'])->name('berkas.create');
    Route::post('berkas', [BerkasController::class, 'store'])->name('berkas.store');
    Route::get('berkas/{id}', [BerkasController::class, 'show'])->name('berkas.show');
    Route::get('berkas/{id}/edit', [BerkasController::class, 'edit'])->name('berkas.edit');
    Route::put('berkas/{id}', [BerkasController::class, 'update'])->name('berkas.update');
    Route::delete('berkas/{id}', [BerkasController::class, 'destroy'])->name('berkas.destroy');

    //Route laporan
    Route::get('laporan/pegawai', [LaporanController::class, 'pegawai'])->name('laporan.pegawai');
    Route::get('laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi');
    Route::get('laporan/cuti', [LaporanController::class, 'cuti'])->name('laporan.cuti');
});

// LOGIN GOOGLE
// Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/redirect', [SocialiteController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/callback', [SocialiteController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout', [SocialiteController::class, 'logout'])->name('socialite.logout')->middleware('auth');

Auth::routes();

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('dashboard', function () {
        return view('user.dashboard.index');
    });
    // Route::get('dashboard', [HomeController::class, 'index1'])->name('dashboard');

    // Route::get('absensi', [WelcomeController::class, 'index'])->name('welcome.index');
    Route::get('/absensi', [WelcomeController::class, 'index'])->middleware('auth');
    Route::resource('/absensi', WelcomeController::class)->names('welcome');
    Route::put('/{id}/update', [WelcomeController::class, 'update'])->name('welcome.update');
    Route::get('absensi/create', [WelcomeController::class, 'create'])->name('welcome.create');
    Route::post('absensi', [WelcomeController::class, 'store'])->name('welcome.store');
    Route::get('absensi/{id}/edit', [WelcomeController::class, 'edit'])->name('welcome.edit');
    Route::post('absensi/{id}', [WelcomeController::class, 'update'])->name('welcome.update');
    Route::post('/absen-sakit', [WelcomeController::class, 'absenSakit'])->name('welcome.absenSakit');
    Route::post('/absen-pulang', [WelcomeController::class, 'absenPulang'])->name('welcome.absenPulang');
    // Route::post('/absen-sakit', [WelcomeController::class, 'absenSakit'])->name('welcome.absenSakit');

    Route::get('penggajian', [PenggajianController::class, 'index1'])->name('penggajian.index1');
    Route::get('penggajian/create', [PenggajianController::class, 'create1'])->name('penggajian.create1');
    Route::post('penggajian', [PenggajianController::class, 'store1'])->name('penggajian.store1');
    Route::get('penggajian/{id}', [PenggajianController::class, 'show1'])->name('penggajian.show1');
    Route::get('penggajian/{id}/edit', [PenggajianController::class, 'edit1'])->name('penggajian.edit1');
    Route::put('penggajian/{id}', [PenggajianController::class, 'update1'])->name('penggajian.update1');
    Route::delete('penggajian/{id}', [PenggajianController::class, 'destroy1'])->name('penggajian.destroy1');

    Route::get('profile', function () {
        return view('user.profile.index');
    });

    Route::get('/izin-sakit', [WelcomeController::class, 'izinSakit'])->name('izin.sakit');

    Route::get('cuti', [CutisController::class, 'index1'])->name('cuti.index1');
    // Route::post('/cuti/store', [CutisController::class, 'store1'])->name('cuti.store1');d
    Route::post('/cuti/store', [CutisController::class, 'store1'])->name('cuti.store1');

    Route::patch('/cuti/update-status/{id}', [CutisController::class, 'updateStatus'])->name('cuti.updateStatus');

});
