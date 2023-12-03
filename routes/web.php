<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//Nguoi_dung
//dang nhap dang ky dang xuat
Route::get('dang_nhap',[App\Http\Controllers\Nguoi_dung_controller::class, 'view_dang_nhap'])->name('dang_nhap');
Route::post('dang_nhap_process',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_dang_nhap']);
Route::get('dang_xuat',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_dang_xuat'])->name('dang_xuat');
//giao dien
Route::get('quan_ly_nguoi_dung/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_quan_ly_nguoi_dung'])->name('quan_ly_nguoi_dung');
Route::get('quan_ly_nguoi_dung_search/{keyword}/{state}/{pos}/{hasKey}/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_tim_kiem_keyword'])->name('quan_ly_nguoi_dung_search_keyword');
Route::get('quan_ly_nguoi_dung_search/{state}/{pos}/{hasKey}/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_tim_kiem'])->name('quan_ly_nguoi_dung_search');
Route::post('tim_kiem_nguoi_dung_process',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_tim_kiem']);
//them sua xoa
Route::post('them_nguoi_dung',[\App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_them']);
Route::post('sua_nguoi_dung', [\App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_sua']);
Route::get('xoa_nguoi_dung_process/{tai_khoan}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_xoa'])->name('xoa_nguoi_dung');

//Danh sach tuong
//giao dien
Route::get('quan_ly_danh_sach_tuong/{page}',[\App\Http\Controllers\Danh_sach_tuong_controller::class, 'view_quan_ly_danh_sach_tuong'])->name('quan_ly_danh_sach_tuong');
Route::get('quan_ly_danh_sach_tuong_search/{keyword}/{page}', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'view_tim_kiem_keyword'])->name('quan_ly_danh_sach_tuong_search');
Route::post('tim_kiem_tuong_process', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_tim_kiem'])->name('tim_kiem_tuong');
//them sua xoa
Route::post('them_tuong', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_them']);
Route::post('sua_tuong', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_sua']);
Route::get('xoa_tuong_process/{ma_tuong}', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_xoa'])->name('xoa_tuong');

//Khach hang
//giao dien
Route::get('dang_ky',[App\Http\Controllers\Khach_hang_controller::class, 'view_dang_ky'])->name('dang_ky');
Route::get('quan_ly_khach_hang/{page}',[\App\Http\Controllers\Khach_hang_controller::class, 'view_quan_ly_khach_hang'])->name('quan_ly_khach_hang');
// Route::get('quan_ly_danh_sach_tuong_search/{keyword}/{page}', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'view_tim_kiem_keyword'])->name('quan_ly_danh_sach_tuong_search');
// Route::post('tim_kiem_tuong_process', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_tim_kiem'])->name('tim_kiem_tuong');
// //them sua xoa
Route::post('them_khach_hang',[\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_dang_ky']);
// Route::post('sua_tuong', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_sua']);
Route::get('xoa_khach_hang_process/{ma_khach_hang}', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_xoa'])->name('xoa_khach_hang');

/*_____________________________________________________HOME_______________________________________________________________________*/
//danh sach tuong
Route::get('danh_sach_tuong', [App\Http\Controllers\Danh_sach_tuong_controller::class, 'view_danh_sach_tuong'])->name('danh_sach_tuong');

