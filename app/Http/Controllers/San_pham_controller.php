<?php

namespace App\Http\Controllers;

use App\Models\Danh_sach_tuong;
use App\Models\Do_hiem;
use App\Models\Dong_skin;
use App\Models\Trang_phuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class San_pham_controller extends Controller
{
    public function view_quan_ly_sp_skin($page)
	{
		if (session('nguoi_dung') != null) {
			$tuongs = Danh_sach_tuong::all();
            $do_hiems = Do_hiem::all();
            $dong_skins = Dong_skin::all();
			$data = [];
			$page_length = 6;
			$all_skins = Trang_phuc::all();
			$data['skins'] =  $all_skins->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($all_skins->count() / $page_length);
			if ($all_skins->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_sp_skin.quan_ly_sp_skin', $data)->with('tuongs', $tuongs)->with('do_hiems', $do_hiems)->with('dong_skins', $dong_skins);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_them_skin(Request $request){
        $skin = new Trang_phuc();
        $skin->ten_trang_phuc = $request->ten_skin;
        $skin->ma_do_hiem = $request->do_hiem;
        $skin->ma_tuong = $request->add_tuong;
        $skin->ma_dong_skin = $request->dong_skin;
        $skin->mo_ta = $request->mo_ta;
        $skin->trang_thai = $request->state;
        if ($request->hasFile('hinh_anh')) {
            $img = $request->hinh_anh;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
            //.move() mặc định ở public
            $img->move('skin', $imgname);
            $skin->hinh_anh = $imgname;
        } else {
            $skin->hinh_anh = "";
        }
        if ($request->hasFile('model')) {
            $model = $request->model;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $modelname = md5(time() . $model->getClientOriginalName()) . '.' . $model->getClientOriginalExtension();
            //.move() mặc định ở public
            $model->move('skin', $modelname);
            $skin->model = $modelname;
        } else {
            $skin->model = "";
        }
        $skin->save();
        return redirect()->route('quan_ly_skin', 1);
    }
    public function xu_ly_sua_skin(Request $request){
        $skin = Trang_phuc::find($request->ma_skin);
        $skin->ten_trang_phuc = $request->up_ten_skin;
        $skin->ma_do_hiem = $request->up_do_hiem;
        $skin->ma_tuong = $request->up_tuong;
        $skin->ma_dong_skin = $request->up_dong_skin;
        $skin->mo_ta = $request->up_mo_ta;
        $skin->trang_thai = $request->up_state;
        if ($request->hasFile('up_hinh_anh')) {
            $img = $request->up_hinh_anh;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
            //.move() mặc định ở public
            $img->move('skin', $imgname);
            if(File::exists('skin/' . $skin->hinh_anh)){
                File::delete('skin/' . $skin->hinh_anh);
            }
            $skin->hinh_anh = $imgname;
        } else {
            $skin->hinh_anh = "";
        }
        if ($request->hasFile('up_model')) {
            $model = $request->up_model;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $modelname = md5(time() . $model->getClientOriginalName()) . '.' . $model->getClientOriginalExtension();
            //.move() mặc định ở public
            $model->move('skin', $modelname);
            if(File::exists('skin/' . $skin->model)){
                File::delete('skin/' . $skin->model);
            }
            $skin->model = $modelname;
        } else {
            $skin->model = "";
        }
        $skin->save();
        return redirect()->route('quan_ly_skin', 1);
    }
    public function xu_ly_xoa_skin(Request $request){
        $skin = Trang_phuc::find($request->ma_trang_phuc);
        $skin->delete();
        if(File::exists('skin/' . $skin->hinh_anh)){
            File::delete('skin/' . $skin->hinh_anh);
        }
        if(File::exists('skin/' . $skin->model)){
            File::delete('skin/' . $skin->model);
        }
        return redirect()->route('quan_ly_skin', 1);
    }
}
