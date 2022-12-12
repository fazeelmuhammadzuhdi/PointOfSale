<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
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

//Member
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

//Pembelian
Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::resource('/pembelian', PembelianController::class)->except('create');

//Pembelian Detail
Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian-detail.data');
Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
Route::resource('/pembelian-detail', PembelianDetailController::class)->except('create', 'show', 'edit');


//Transaksi Penjualan
Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');

Route::resource('/transaksi', PenjualanDetailController::class)
    ->except('create', 'show', 'edit');

//Penjualan
Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
