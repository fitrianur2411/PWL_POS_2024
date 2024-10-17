<?php


use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
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

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware(['auth'])->group(function () {


//Jobsheet 5
Route::get('/', [WelcomeController::class,'index']);

Route::group(['prefix'=> 'user','middleware'=> 'authorize:ADM,MNG'], function(){
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


Route::middleware(['authorize:ADM'])->group(function(){
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
});

Route::middleware(['authorize:ADM,MNG'])->group(function(){
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
    Route::get('/import', [BarangController::class, 'import']);  //ajax form upload excel
    Route::post('/import_ajax', [BarangController::class, 'import_ajax']);  //ajax import excel

});
});


Route::group(['prefix'=> 'kategori','middleware'=> 'authorize:ADM,MNG'], function(){
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

Route::group(['prefix'=> 'supplier', 'middleware'=> 'authorize:ADM,MNG'], function(){
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

    
Route::group(['prefix'=> 'stok','middleware'=> 'authorize:ADM,MNG,STF'], function(){
    Route::get('/', [StokController::class, 'index']);          //menampilkan halaman awal Stok
    Route::post('/list', [StokController::class, 'list']);      //menampilkan data Stok dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create']);   //menammpilkan halaman form tambah Stok
    Route::post('/', [StokController::class, 'store']);         //menyimpan data Stok baru
    Route::get('/create_ajax', [StokController::class, 'create_ajax']);  //menampilkan halaman form tambah Stok Ajax
    Route::post('/ajax', [StokController::class, 'store_ajax']);         //menyimpan data Stok baru Ajax
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);  //menampilkan halaman form edit Stok Ajax
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);  //Menyimpan halaman form edit Stok Ajax
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);  //tampilan form confirm delete Stok Ajax
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); //menghapus data Stok Ajax
    Route::get('/{id}', [StokController::class, 'show']);       //menampilkan detail Stok
    Route::get('/{id}/edit', [StokController::class, 'edit']);  //menampilkan halaman form detail Stok
    Route::put('/{id}', [StokController::class, 'update']);     //menyimpan perubahan data Stok
    Route::delete('/{id}', [StokController::class, 'destroy']); //menghapus data Stok
});  

Route::group(['prefix'=> 'penjualan','middleware'=> 'authorize:ADM,MNG,STF'], function(){
    Route::get('/', [PenjualanController::class, 'index']);          //menampilkan halaman awal Penjualan
    Route::post('/list', [PenjualanController::class, 'list']);      //menampilkan data Penjualan dalam bentuk json untuk datatables
    Route::get('/create', [PenjualanController::class, 'create']);   //menammpilkan halaman form tambah Penjualan
    Route::post('/', [PenjualanController::class, 'store']);         //menyimpan data Penjualan baru
    Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);  //menampilkan halaman form tambah Penjualan Ajax
    Route::post('/ajax', [PenjualanController::class, 'store_ajax']);         //menyimpan data Penjualan baru Ajax
    Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);  //menampilkan halaman form edit Penjualan Ajax
    Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);  //Menyimpan halaman form edit Penjualan Ajax
    Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);  //tampilan form confirm delete Penjualan Ajax
    Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); //menghapus data Penjualan Ajax
    Route::get('/{id}', [PenjualanController::class, 'show']);       //menampilkan detail Penjualan
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']);  //menampilkan halaman form detail Penjualan
    Route::put('/{id}', [PenjualanController::class, 'update']);     //menyimpan perubahan data Penjualan
    Route::delete('/{id}', [PenjualanController::class, 'destroy']); //menghapus data Penjualan
        
});    
});

