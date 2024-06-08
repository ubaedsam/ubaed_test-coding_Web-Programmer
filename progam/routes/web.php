<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PemesananProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UtamaController;

Route::get('/', [UtamaController::class, 'index'])->name('index');
// Proses Mencari Data Produk
Route::post('/getProduk', [UtamaController::class, 'getProduk'])->name('utama.getProduk');
// Proses Menampilkan Detail Produk
Route::put('/checkProduk/{id_produk}', [UtamaController::class, 'checkProduk']);
// Proses Mengubah Jumlah Pemesanan Produk
Route::post('/update-quantity', [UtamaController::class, 'updateQuantity']);
// Proses Pemesanan Produk
Route::post('pembelian/pemesananProduk', [PemesananProdukController::class, 'pemesananProduk'])->name('data.pemesananProduk.store');
// Halaman Pengolahan Data Pemesanan Produk
Route::get('pembelian', [PemesananProdukController::class, 'pemesananProdukAll'])->name('pembelian');

// Auth (Sebelum Login)
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'custom_registration'])->name('register.custom');
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'custom_login'])->name('login.custom');
// Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

// Untuk Costumer

// Mengambil Data Pemesanan Produk
Route::get('pembelian/dataProdukOfficer', [PemesananProdukController::class, 'dataProdukOfficer'])->name('data.pemesanan_produk_officer');
// Proses Mengambil Satu Data Pemesanan Produk Untuk Diubah
Route::put('pembelian/ubahPemesananProdukOfficer/{id_pemesanan_produk}', [PemesananProdukController::class, 'ubahPemesananProdukOfficer'])->name('data.pemesanan_produk_officer.ubah');

// Untuk Merchant

// Halaman Pengolahan Data Produk
Route::get('produk', [ProdukController::class, 'index'])->name('produk')->middleware('checkmerchant');
// Mengambil Data Produk
Route::get('produk/dataProduk', [ProdukController::class, 'dataProduk'])->name('data.produk');
// Proses Menambah Data Produk
Route::post('produk/storeProduk', [ProdukController::class, 'storeProduk'])->name('data.produk.store');
// Proses Mengambil Satu Data Produk Untuk Diubah
Route::put('produk/ubahProduk/{id_produk}', [ProdukController::class, 'ubahProduk'])->name('data.produk.ubah');
// Proses Mengubah Data Produk Untuk Diubah
Route::put('produk/prosesUbahProduk/{id_produk}', [ProdukController::class, 'prosesUbahProduk'])->name('data.produk.proses');
// Proses Menghapus Data Produk
Route::delete('produk/prosesHapusProduk/{id_produk}', [ProdukController::class, 'prosesHapusProduk'])->name('data.produk.hapus');

// Mengambil Data Pemesanan Produk
Route::get('pembelian/dataPemesananMerchant', [PemesananProdukController::class, 'dataPemesananMerchant'])->name('data.pemesanan_produk_merchant');
// Approve Data Pemesanan Produk
Route::get('pembelian/approveMerchant/{id_pemesanan_produk}', [PemesananProdukController::class, 'approve_merchant']);
