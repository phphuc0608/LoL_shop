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
Route::get('quen_mk',[App\Http\Controllers\Nguoi_dung_controller::class, 'view_quen_mk'])->name('quen_mk');
Route::post('quen_mk_process',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_quen_mk']);
Route::get('dang_xuat',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_dang_xuat'])->name('dang_xuat');
Route::get('thong_ke',[App\Http\Controllers\Nguoi_dung_controller::class, 'view_thong_ke'])->name('thong_ke');
//giao dien
Route::get('quan_ly_nguoi_dung/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_quan_ly_nguoi_dung'])->name('quan_ly_nguoi_dung');
Route::get('quan_ly_nguoi_dung_search/{keyword}/{state}/{pos}/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_tim_kiem'])->name('quan_ly_nguoi_dung_search');
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
Route::get('quan_ly_khach_hang_search/{tk}/{email}/{state}/{page}', [\App\Http\Controllers\Khach_hang_controller::class, 'view_tim_kiem'])->name('quan_ly_khach_hang_search');
Route::post('tim_kiem_khach_hang_process', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_tim_kiem'])->name('tim_kiem_khach_hang');
//them sua xoa
Route::post('them_khach_hang',[\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_dang_ky']);
Route::post('sua_khach_hang', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_sua']);
Route::get('xoa_khach_hang_process/{ma_khach_hang}', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_xoa'])->name('xoa_khach_hang');

//San pham
//skin
//giao dien
Route::get('quan_ly_sp_skin/{page}',[\App\Http\Controllers\San_pham_controller::class, 'view_quan_ly_sp_skin'])->name('quan_ly_skin');
Route::get('quan_ly_sp_skin_search/{keyword}/{champ}/{state}/{page}', [\App\Http\Controllers\San_pham_controller::class, 'view_tim_kiem_sp_skin'])->name('quan_ly_skin_search');
Route::post('tim_kiem_skin_process', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_skin'])->name('tim_kiem_skin');
//them sua xoa
Route::post('them_skin',[\App\Http\Controllers\San_pham_controller::class, 'xu_ly_them_skin']);
Route::post('sua_skin', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_sua_skin']);
Route::get('xoa_skin_process/{ma_trang_phuc}', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_xoa_skin'])->name('xoa_skin');
//bau vat
//giao dien
Route::get('quan_ly_sp_chest/{page}',[\App\Http\Controllers\San_pham_controller::class, 'view_quan_ly_sp_chest'])->name('quan_ly_chest');
Route::get('quan_ly_sp_chest_search/{keyword}/{type}/{state}/{page}', [\App\Http\Controllers\San_pham_controller::class, 'view_tim_kiem_sp_chest'])->name('quan_ly_chest_search');
Route::post('tim_kiem_chest_process', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_chest'])->name('tim_kiem_chest');
// //them sua xoa
Route::post('them_chest',[\App\Http\Controllers\San_pham_controller::class, 'xu_ly_them_chest']);
Route::post('sua_chest', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_sua_chest']);
Route::get('xoa_chest_process/{ma_bau_vat}', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_xoa_chest'])->name('xoa_chest');
//vat pham
//giao dien
Route::get('quan_ly_sp_item/{page}',[\App\Http\Controllers\San_pham_controller::class, 'view_quan_ly_sp_item'])->name('quan_ly_item');
Route::get('quan_ly_sp_item_search/{keyword}/{type}/{state}/{page}', [\App\Http\Controllers\San_pham_controller::class, 'view_tim_kiem_sp_item'])->name('quan_ly_item_search');
Route::post('tim_kiem_item_process', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_item'])->name('tim_kiem_item');
// //them sua xoa
Route::post('them_item',[\App\Http\Controllers\San_pham_controller::class, 'xu_ly_them_item']);
Route::post('sua_item', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_sua_item']);
Route::get('xoa_item_process/{ma_vat_pham}', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_xoa_item'])->name('xoa_item');


/*_____________________________________________________HOME_______________________________________________________________________*/
//danh sach tuong
Route::get('home_ds_tuong', [App\Http\Controllers\Danh_sach_tuong_controller::class, 'view_home_ds_tuong'])->name('home_ds_tuong');
Route::post('tim_kiem_tuong', [\App\Http\Controllers\Danh_sach_tuong_controller::class, 'xu_ly_tim_kiem_champ_home'])->name('tim_kiem_champ_home');
//trang_phuc
Route::get('home_mua_trang_phuc',[App\Http\Controllers\San_pham_controller::class, 'view_home_mua_trang_phuc'])->name('home_mua_trang_phuc');
Route::post('tim_kiem_trang_phuc', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_skin_home'])->name('tim_kiem_skin_home');
Route::get('tim_kiem_trang_phuc/{keyword}', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_skin_home_keyword'])->name('tim_kiem_skin_home_keyword');
Route::get('chi_tiet_trang_phuc/{keyword}',[App\Http\Controllers\San_pham_controller::class, 'view_chi_tiet_trang_phuc'])->name('chi_tiet_trang_phuc');
//bau_vat
Route::get('home_mua_bau_vat',[App\Http\Controllers\San_pham_controller::class, 'view_home_mua_bau_vat'])->name('home_mua_bau_vat');
Route::post('tim_kiem_bau_vat', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_chest_home'])->name('tim_kiem_chest_home');
Route::get('chi_tiet_bau_vat/{keyword}', [App\Http\Controllers\San_pham_controller::class, 'view_chi_tiet_bau_vat'])->name('chi_tiet_bau_vat');
//vat_pham
Route::get('home_mua_vat_pham',[App\Http\Controllers\San_pham_controller::class, 'view_home_mua_vat_pham'])->name('home_mua_vat_pham');
Route::post('tim_kiem_vat_pham', [\App\Http\Controllers\San_pham_controller::class, 'xu_ly_tim_kiem_item_home'])->name('tim_kiem_item_home');
//khach_hang
Route::get('thong_tin_tai_khoan',[App\Http\Controllers\Khach_hang_controller::class, 'view_thong_tin_tai_khoan'])->name('thong_tin_tai_khoan');
Route::post('cap_nhat_khach_hang', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_cap_nhat_khach_hang']);
Route::get('lich_su_mua_hang', [App\Http\Controllers\Khach_hang_controller::class, 'view_lich_su_mua_hang'])->name('lich_su_mua_hang');
Route::get('gio_hang', [App\Http\Controllers\Khach_hang_controller::class, 'view_gio_hang'])->name('gio_hang');
Route::get('them_gio_hang/{keyword}/{type}', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_them_gio_hang'])->name('xu_ly_them_gio_hang');
Route::get('xoa_gio_hang_process/{keyword}', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_xoa_gio_hang'])->name('xoa_gio_hang');
Route::get('thanh_toan_process/{keyword}/{type}', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_thanh_toan_don'])->name('thanh_toan_don');
Route::get('thanh_toan_toan_bo_process', [\App\Http\Controllers\Khach_hang_controller::class, 'xu_ly_thanh_toan_toan_bo'])->name('thanh_toan_toan_bo');
