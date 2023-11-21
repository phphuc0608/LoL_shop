<?php

namespace App\Http\Controllers;

use App\Models\Nguoi_dung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chuc_nang;

class Nguoi_dung_controller extends Controller
{
    public function view_dang_nhap()
    {
        $data=[];
        $data['bao_loi'] = session('bao_loi');
        return view('admin.Dang_nhap.dang_nhap',$data); 
        // return view('admin.Dang_nhap.dang_nhap'); 
    }
    public function xu_ly_dang_nhap(Request $request){
        $tai_khoan = $request->tai_khoan;
        $mat_khau = md5($request->mat_khau);
        // $mat_khau = $request->mat_khau;
        // Truy cập cột tai_khoan trong bảng Nguoi_dung
        $nguoi_dungs = Nguoi_dung::where('tai_khoan', '=', $tai_khoan);
        session()->put('bao_loi', '');
        // Lưu thông tin lỗi vào session
        if ($nguoi_dungs->count() == 0) {
            session()->put('bao_loi', 'Tài khoản không tồn tại');
        } else {
            $nguoi_dung = $nguoi_dungs->first();
            if ($nguoi_dung->mat_khau != $mat_khau) {
                session()->put('bao_loi', 'Sai mật khẩu');
            } else {
                session()->put('bao_loi', '');
                session()->put('nguoi_dung', $tai_khoan);
                
            }
        }
        // Kiểm tra xem có lỗi không
        if (session('bao_loi') == '') {
            return redirect()->route('quan_ly_nguoi_dung',1);
        } else {
            return redirect()->route('dang_nhap');
        }
    }
    public function view_quan_ly_nguoi_dung($page)
	{
		if (session('nguoi_dung') != null) {
			$chuc_nangs = Chuc_nang::all();
			$data = [];
			$page_length = 4;
			$all_nguoi_dungs = Nguoi_dung::with(['chuc_nang'])->get();
			$data['nguoi_dungs'] =  $all_nguoi_dungs->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($all_nguoi_dungs->count() / $page_length);
			if ($all_nguoi_dungs->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung', $data)->with('chuc_nangs', $chuc_nangs);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
    public function view_dang_ky()
    {
        return view('admin.Dang_ky.dang_ky');
    }
}
