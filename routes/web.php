<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-statistik', [DashboardController::class, 'dashboard'])->name('dashboard-statistik');
});

Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);
Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
Route::resource('/member', MemberController::class);
