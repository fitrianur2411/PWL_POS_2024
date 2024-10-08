<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

//
/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']); 
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']); */

//Jobsheet 5
Route::get('/', [WelcomeController::class,'index']);

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         //Menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);   // menampilkan halaman form tambah user
    Route::post('/ajax', [UserController::class, 'store_ajax']);         // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     // menyimpan perubahan data user
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // menyimpan perubahan data user
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user
    Route::delete('/{id}', [UserController::class, 'destroy']); //mengahapus data user
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);         // Menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);     // Menampilkan data level dalam bentuk jeson untuk datatables
    Route::get('/create', [LevelController::class, 'create']);  // Menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);        // Menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);  // menampilkan halaman form tambah level ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']);   // menyimpan data level baru ajax
    Route::get('/{id}', [LevelController::class, 'show']);      // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);    // Menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class,'edit_ajax']); //menampilkan halaman form edit dengan ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); //menyimpan perubahan data level ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); //menyimpan perubahan data ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); //menghapus data ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']);// Menghapus data level
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);         // Menampilkan halaman awal Barang
    Route::post('/list', [BarangController::class, 'list']);     // Menampilkan data Barang dalam bentuk jeson untuk datatables
    Route::get('/create', [BarangController::class, 'create']);  // Menampilkan halaman form tambah Barang
    Route::post('/', [BarangController::class, 'store']);        // Menyimpan data Barang baru
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);   // menampilkan halaman form tambah barang
    Route::post('/ajax', [BarangController::class, 'store_ajax']);         // menyimpan data barang baru
    Route::get('/{id}', [BarangController::class, 'show']);      // Menampilkan detail Barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // Menampilkan halaman form edit Barang
    Route::put('/{id}', [BarangController::class, 'update']);    // Menyimpan perubahan data Barang
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit supplier ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // menampilkan form confirm delete supplier ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data supplier ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']);// Menghapus data Barang
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);          // Menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);      // Menampilkan data kategori dalam bentuk jeson untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   // Menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);         // Menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);   // menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);         // menyimpan data kategori baru ajax
    Route::get('/{id}', [KategoriController::class, 'show']);       // Menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // Menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     // Menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //  menampilkan form confirm delete kategori ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); //menghapus data kategori ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // Menghapus data kategori
});

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']);          // Menampilkan halaman awal Supplier
    Route::post('/list', [SupplierController::class, 'list']);      // Menampilkan data Supplier dalam bentuk jeson untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);   // Menampilkan halaman form tambah Supplier
    Route::post('/', [SupplierController::class, 'store']);         // Menyimpan data Supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);   // menampilkan halaman form tambah supplier
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);         // menyimpan data supplier baru
    Route::get('/{id}', [SupplierController::class, 'show']);       // Menampilkan detail Supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // Menampilkan halaman form edit Supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // Menyimpan perubahan data Supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit supplier ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // menampilkan form confirm delete supplier ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // hapus data supplier ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // Menghapus data Supplier
});
