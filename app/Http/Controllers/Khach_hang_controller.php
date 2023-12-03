<?php

namespace App\Http\Controllers;

use App\Models\Khach_hang;
use App\Models\Nguoi_dung;
use App\Models\Gio_hang;
use App\Models\Lich_su_mua_hang;
use Illuminate\Http\Request;

class Khach_hang_controller extends Controller
{
    public function view_dang_ky()
    {
        return view('admin.Dang_ky.dang_ky');
    }
    public function xu_ly_dang_ky(Request $request)
	{
		$gio_hang = new Gio_hang();
		$lich_su_mua_hang = new Lich_su_mua_hang();
		$gio_hang->ds_hang = '';
		$lich_su_mua_hang->ds_ls_mua_hang = '';
		$gio_hang->save();
		$lich_su_mua_hang->save();
		$nguoi_dung = new Nguoi_dung();
        $khach_hang = new Khach_hang();
        $khach_hang->email = $request->email;
		$nguoi_dung->tai_khoan = $request->tai_khoan;
        $khach_hang->tai_khoan = $request->tai_khoan;
		$nguoi_dung->mat_khau = md5($request->mat_khau);
		$nguoi_dung->ma_chuc_nang = 3;
		$nguoi_dung->trang_thai = 1;
		$khach_hang->ma_ls_mua_hang = $lich_su_mua_hang->ma_ls_mua_hang;
		$khach_hang->ma_gio_hang = $gio_hang->ma_gio_hang;
		$nguoi_dung->save();
		$khach_hang->save();
		
		return redirect()->route('dang_nhap');
	}
    public function view_quan_ly_khach_hang($page)
	{
		if (session('nguoi_dung') != null) {
            $all_khach_hangs = Khach_hang::all();
			$data = [];
			$page_length = 6;
			$data['khach_hangs'] =  $all_khach_hangs->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($all_khach_hangs->count() / $page_length);
			if ($all_khach_hangs->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_khach_hang.quan_ly_khach_hang', $data);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_xoa($ma_khach_hang){
		$khach_hang = Khach_hang::find($ma_khach_hang);
		$nguoi_dung = Nguoi_dung::where('tai_khoan','=',$khach_hang->tai_khoan)->first();
        $gio_hang = Gio_hang::where('ma_gio_hang','=',$khach_hang->ma_gio_hang)->first();
        $lich_su_mua_hang = Lich_su_mua_hang::where('ma_ls_mua_hang','=',$khach_hang->ma_ls_mua_hang)->first();
        $khach_hang->delete();
        $nguoi_dung->delete();
		$gio_hang->delete();
        $lich_su_mua_hang->delete();
		return redirect()->route('quan_ly_khach_hang',1);
	}

}
