<?php

namespace App\Http\Controllers;

use App\Models\Nguoi_dung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            return redirect()->route('quan_ly_nguoi_dung');
        } else {
            return redirect()->route('dang_nhap');
        }
    }
    public function view_quan_ly_nguoi_dung()
    {
        return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung');
    }
}
