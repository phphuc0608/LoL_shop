<?php

namespace App\Http\Controllers;

use App\Models\Danh_sach_tuong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Danh_sach_tuong_controller extends Controller
{
    public function view_quan_ly_danh_sach_tuong($page)
    {
        if (session('nguoi_dung') !=null && session('chuc_nang') == 'admin') {
            $data = [];
            $page_length = 10;
            $tuongs = Danh_sach_tuong::all();
            $data['tuongs'] =  $tuongs->skip(($page - 1) * $page_length)->take($page_length);
            $page_number = (int)($tuongs->count() / $page_length);
            if ($tuongs->count() % $page_length > 0) {
                $page_number++;
            }
            $data['page_number'] = $page_number;
            $data['page'] = $page;
            return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong', $data);
        } else {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
    }

    public function xu_ly_them(Request $request){
        $tuong = new Danh_sach_tuong();
        $tuong->ten_tuong = $request->ten_tuong;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->hinh_anh;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            //.move() mặc định ở public
            $file->move('danh_sach_tuong', $filename);
            $tuong->hinh_anh = $filename;
        } else {
            $tuong->hinh_anh = "";
        }
        $tuong->save();
        return redirect()->route('quan_ly_danh_sach_tuong', 1);
    }

    public function xu_ly_sua(Request $request){
        $tuong = Danh_sach_tuong::find($request->ma_tuong);
        $tuong->ten_tuong = $request->ten_tuong;
        if($request->hasFile('hinh_anh')){
            $file = $request->hinh_anh;
            $filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->move('danh_sach_tuong', $filename);
            if(File::exists('danh_sach_tuong/' . $tuong->hinh_anh)){
                File::delete('danh_sach_tuong/' . $tuong->hinh_anh);
            }
            $tuong->hinh_anh = $filename;
        }
        $tuong->save();
        return redirect()->route('quan_ly_danh_sach_tuong', 1);
    }
    public function xu_ly_xoa(Request $request){
        $tuong = Danh_sach_tuong::find($request->ma_tuong);
        $tuong->delete();
        if(File::exists('danh_sach_tuong/' . $tuong->hinh_anh)){
            File::delete('danh_sach_tuong/' . $tuong->hinh_anh);
        }
        return redirect()->route('quan_ly_danh_sach_tuong', 1);
    }
    public function xu_ly_tim_kiem(Request $request)
    {
        $ten_tuong = $request->ten_tuong;
        if($ten_tuong!=null){
            return redirect()->route('quan_ly_danh_sach_tuong_search', ['keyword' => $ten_tuong, 'page' => 1]);
        }
        else{
            return redirect()->route('quan_ly_danh_sach_tuong', 1);
        }
    }
    public function view_tim_kiem_keyword($keyword, $page){
        if (session('nguoi_dung') !=null && session('chuc_nang') == 'admin') {
            $tim_kiems = Danh_sach_tuong::where('ten_tuong', 'like', '%' . $keyword . '%')->get();
            $data = [];
            $page_length = 10;
            $data['tim_kiems'] =  $tim_kiems->skip(($page - 1) * $page_length)->take($page_length);
            $page_number = (int)($tim_kiems->count() / $page_length);
            if ($tim_kiems->count() % $page_length > 0) {
                $page_number++;
            }
            if ($tim_kiems->count()==0) {
				$data['empty'] = 1;
			}
            else{
                $data['empty'] = 0;
            }
            $data['page_number'] = $page_number;
            $data['page'] = $page;
            $data['keyword'] = $keyword;
            return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong_search', $data);
        } else {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
    }

    public function view_home_ds_tuong()
    {
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $tuongs = Danh_sach_tuong::all();
        $nguoi_dung = session('nguoi_dung');
        $search=0;
        return view('home.Danh_sach_tuong.danh_sach_tuong', ['tuongs' => $tuongs, 'nguoi_dung' => $nguoi_dung, 'search' => $search]);
    }
    public function xu_ly_tim_kiem_champ_home(Request $request)
	{
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
		$data['keyword'] = $request->keyword;
        $tuongs='';
        $data['search'] = 1;
        if($data['keyword'] != null){
            $tuongs = Danh_sach_tuong::where('ten_tuong','like','%'.$data['keyword']. '%')->get();
        }
        else{
            $tuongs = Danh_sach_tuong::all();
        }
        $data['tuongs'] = $tuongs;
        // echo $tuongs->toSql();
		return view('home.Danh_sach_tuong.danh_sach_tuong', $data);
	}
}
