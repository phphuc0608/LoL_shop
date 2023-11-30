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
Route::get('dang_nhap',[App\Http\Controllers\Nguoi_dung_controller::class, 'view_dang_nhap'])->name('dang_nhap');
Route::post('dang_nhap_process',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_dang_nhap']);
Route::get('quan_ly_nguoi_dung/{page}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_quan_ly_nguoi_dung'])->name('quan_ly_nguoi_dung');
Route::post('them_nguoi_dung',[\App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_them']);
Route::get('dang_ky',[App\Http\Controllers\Nguoi_dung_controller::class, 'view_dang_ky'])->name('dang_ky');
Route::post('them_khach_hang',[\App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_dang_ky']);
Route::get('quan_ly_nguoi_dung_search/{page}/{keyword}/{state}/{pos}/{hasKey}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_tim_kiem_keyword'])->name('quan_ly_nguoi_dung_search_keyword');
Route::get('quan_ly_nguoi_dung_search/{page}/{state}/{pos}/{hasKey}', [\App\Http\Controllers\Nguoi_dung_controller::class, 'view_tim_kiem'])->name('quan_ly_nguoi_dung_search');
Route::post('tim_kiem_process',[App\Http\Controllers\Nguoi_dung_controller::class, 'xu_ly_tim_kiem']);