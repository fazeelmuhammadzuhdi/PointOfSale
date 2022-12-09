<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
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

//Supplier
Route::get('supplier-index', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('supplier-store', [SupplierController::class, 'store'])->name('supplier.store');
Route::post('supplier-edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('supplier-update', [SupplierController::class, 'update'])->name('supplier.update');
Route::post('supplier-hapus', [SupplierController::class, 'destroy'])->name('supplier.hapus');

//Pengeluaran
Route::get('pengeluaran-index', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::post('pengeluaran-store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::post('pengeluaran-edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
Route::post('pengeluaran-update', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::post('pengeluaran-hapus', [PengeluaranController::class, 'destroy'])->name('pengeluaran.hapus');

Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::resource('/pembelian', PembelianController::class)->except('create');

Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian-detail.data');
Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
Route::resource('/pembelian-detail', PembelianDetailController::class)->except('create', 'show', 'edit');
