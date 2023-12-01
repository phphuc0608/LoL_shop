<?php

namespace App\Http\Controllers;

use App\Models\Danh_sach_tuong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class Danh_sach_tuong_controller extends Controller
{
    public function view_quan_ly_danh_sach_tuong($page)
    {
        if (session('nguoi_dung') != null) {
            $data = [];
            $page_length = 4;
            $tuong = Danh_sach_tuong::all();
            $data['danh_sach_tuongs'] =  $tuong->skip(($page - 1) * $page_length)->take($page_length);
            $page_number = (int)($tuong->count() / $page_length);
            if ($tuong->count() % $page_length > 0) {
                $page_number++;
            }
            $data['page_number'] = $page_number;
            $data['page'] = $page;
            return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong', $data);
        } else {
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
        $ten_tuong = $request->input('ten_tuong');
        return redirect()->route('quan_ly_danh_sach_tuong_search', ['ten_tuong' => $ten_tuong, 'page' => 1]);
    }
    public function view_quan_ly_danh_sach_tuong_search($ten_tuong, $page){
        if (session('nguoi_dung') != null) {
            $tim_kiems = Danh_sach_tuong::where('ten_tuong', 'like', '%' . $ten_tuong . '%')->get();
            $data = [];
            $page_length = 4;
            $data['danh_sach_tuongs'] =  $tim_kiems->skip(($page - 1) * $page_length)->take($page_length);
            $page_number = (int)($tim_kiems->count() / $page_length);
            if ($tim_kiems->count() % $page_length > 0) {
                $page_number++;
            }
            $data['page_number'] = $page_number;
            $data['page'] = $page;
            return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong_search', $data)->with('tim_kiems', $tim_kiems);
        } else {
            return redirect()->route('dang_nhap');
        }
    }
    // private function view_quan_ly_danh_sach_tuongWithResults($danh_sach_tuongs, $page)
    // {
    //     if (session('nguoi_dung') != null) {
    //         $data = [];
    //         $page_length = 4;
    //         $data['danh_sach_tuongs'] = $danh_sach_tuongs->skip(($page - 1) * $page_length)->take($page_length);
    //         $page_number = (int)($danh_sach_tuongs->count() / $page_length);
    //         if ($danh_sach_tuongs->count() % $page_length > 0) {
    //             $page_number++;
    //         }
    //         $data['page_number'] = $page_number;
    //         $data['page'] = $page;
    //         return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong', $data);
    //     } else {
    //         return redirect()->route('dang_nhap');
    //     }
    // }

}
