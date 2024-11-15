<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\NhapHang\NhaCungCapController;
use App\Http\Controllers\Admin\NhapHang\CongNoController;
use App\Http\Controllers\Admin\NhapHang\LoaiHangHoaController;
use App\Http\Controllers\Admin\NhapHang\HangHoaController;
use App\Http\Controllers\Admin\NhapHang\NhapHangController;
use App\Http\Controllers\Admin\BanHang\HoaDonController;
use App\Http\Controllers\Admin\BanHang\KhachHangController;
use App\Http\Controllers\Admin\NhapHang\CongNoDaiLyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\NhapHang\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'getlogin'])->name('getlogin');
Route::post('/', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('admin')->name('admin.')->middleware('check_login')->group(function () {
    Route::get('/', [BaseController::class, 'index'])->name('index');

    Route::controller(HoaDonController::class)->prefix('hoa-don')->name('_hoa_don.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/indexNhapHang', 'indexNhapHang')->name('indexNhapHang');

        Route::get('/show/{id}{vu}', 'show')->name('show');
        Route::get('/showLichSuDatHang/{id}', 'showLichSuDatHang')->name('showLichSuDatHang');

        Route::get('/fetchKhachHang', 'fetchKhachHang')->name('fetchKhachHang');
        Route::get('/fetchChonKhachHang', 'fetchChonKhachHang')->name('fetchChonKhachHang');

        Route::get('/fetchKhachHangNhap', 'fetchKhachHangNhap')->name('fetchKhachHangNhap');

        Route::get('/fetchHangHoa', 'fetchHangHoa')->name('fetchHangHoa');
        Route::get('/fetchFullHangHoa', 'fetchFullHangHoa')->name('fetchFullHangHoa');
        Route::get('/fetchHangHoaHien/{id}', 'fetchHangHoaHien')->name('fetchHangHoaHien');
        Route::get('/fetchHangHoaTable', 'fetchHangHoaTable')->name('fetchHangHoaTable');

        Route::get('/pdf/{MaHoaDon}', 'createPDF')->name('createPDF');

        Route::get('/create', 'create')->name('create');
        Route::get('/createNhapHang', 'createNhapHang')->name('createNhapHang');
        Route::post('/create', 'store')->name('store');
        Route::post('/storeNhapHang', 'storeNhapHang')->name('storeNhapHang');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(KhachHangController::class)->prefix('khach-hang')->name('_khach_hang.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/importUser', 'importUser')->name('importUser');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(CongNoController::class)->prefix('cong-no')->name('_cong_no.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/show/{id}', 'show')->name('show');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(CongNoDaiLyController::class)->prefix('cong-no-dai-ly')->name('_cong_no_dai_ly.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/show/{id}', 'show')->name('show');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(HangHoaController::class)->prefix('hang-hoa')->name('_hang_hoa.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/import', 'import')->name('import');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(LoaiHangHoaController::class)->prefix('loai-hang-hoa')->name('_loai_hang_hoa.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/import', 'import')->name('import');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(NhaCungCapController::class)->prefix('nha-cung-cap')->name('_nha_cung_cap.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(NhapHangController::class)->prefix('nhap-hang')->name('_nhap_hang.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });

    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });
});
