<?php

namespace App\Http\Controllers;

use App\Models\Bau_vat;
use App\Models\Danh_sach_tuong;
use App\Models\Do_hiem;
use App\Models\Dong_skin;
use App\Models\Loai_bau_vat;
use App\Models\Loai_vat_pham;
use App\Models\Trang_phuc;
use App\Models\Vat_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class San_pham_controller extends Controller
{
    public function view_quan_ly_sp_skin($page)
	{
		if (session('nguoi_dung') != null&& session('chuc_nang') == 'admin') {
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
            session()->flush();
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_tim_kiem_skin(Request $request)
	{
		$ten_trang_phuc = $request->ten_trang_phuc;
        $ma_tuong = $request->tuong;
		$trang_thai = $request->trang_thai;
		if($ten_trang_phuc==null){
			$ten_trang_phuc = '\0';
		}
		return redirect()->route('quan_ly_skin_search',['page' => 1, 'keyword' => $ten_trang_phuc, 'state' => $trang_thai, 'champ' => $ma_tuong]);
	}
    public function view_tim_kiem_sp_skin($keyword,$champ,$state,$page)
	{
		if (session('nguoi_dung') != null&& session('chuc_nang') == 'admin') {
			if($keyword != '\0') {
				if($champ==0&&$state==-1){
					$tim_kiems = Trang_phuc::where('ten_trang_phuc','like','%'.$keyword. '%')->get();
				}
				elseif($champ!=0&&$state==-1){
					$tim_kiems = Trang_phuc::where('ten_trang_phuc','like','%'.$keyword. '%',)
					->where('ma_tuong','=',$champ)->get();
				}
				elseif($champ==0&&$state!=-1){
					$tim_kiems = Trang_phuc::where('ten_trang_phuc','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)->get();
				}
				else{
					$tim_kiems = Trang_phuc::where('ten_trang_phuc','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)
					->where('ma_tuong','=',$champ)->get();
				}
			}
			else{
				if($champ==0&&$state==-1){
					$tim_kiems = Trang_phuc::all();
				}
				elseif($champ!=0&&$state==-1){
					$tim_kiems = Trang_phuc::where('ma_tuong','=',$champ)->get();
				}
				elseif($champ==0&&$state!=-1){
					$tim_kiems = Trang_phuc::where('trang_thai','=',$state)->get();
				}
				else{
					$tim_kiems = Trang_phuc::where('trang_thai','=',$state)
					->where('ma_tuong','=',$champ)->get();
				}
			}
			$tuongs = Danh_sach_tuong::all();
            $do_hiems = Do_hiem::all();
            $dong_skins = Dong_skin::all();
			$data = [];
			$page_length = 6;
			// $all_tim_kiems = $tim_kiems->with(['tuong'])->get();
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
			$data['state'] = $state;
			$data['champ'] = $champ;
			$data['keyword'] = $keyword;
			return view('admin.Quan_ly_sp_skin.quan_ly_sp_skin_search', $data)->with('tuongs', $tuongs)->with('do_hiems', $do_hiems)->with('dong_skins', $dong_skins);
		} else {
            session()->flush();
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_them_skin(Request $request){
        $skin = new Trang_phuc();
        $skin->ten_trang_phuc = $request->ten_skin;
        $skin->ma_do_hiem = $request->do_hiem;
        $skin->ma_tuong = $request->add_tuong;
        $skin->ma_dong_skin = $request->dong_skin;
        $skin->trang_thai = $request->state;
        $skin->loai_san_pham = 'trang_phuc';
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
/*----------------------------------------------------------------*/
    public function view_quan_ly_sp_chest($page)
	{
		if (session('nguoi_dung') != null&& session('chuc_nang') == 'admin') {
			$loai_bau_vats = Loai_bau_vat::all();
			$data = [];
			$page_length = 6;
			$all_chests = Bau_vat::all();
			$data['chests'] =  $all_chests->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($all_chests->count() / $page_length);
			if ($all_chests->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_sp_chest.quan_ly_sp_chest', $data)->with('loai_bau_vats', $loai_bau_vats);
		} else {
            session()->flush();
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_tim_kiem_chest(Request $request)
	{
		$ten_bau_vat = $request->ten_bau_vat;
        $ma_loai_bau_vat = $request->loai_bau_vat;
		$trang_thai = $request->trang_thai;
		if($ten_bau_vat==null){
			$ten_bau_vat = '\0';
		}
		return redirect()->route('quan_ly_chest_search',['page' => 1, 'keyword' => $ten_bau_vat, 'state' => $trang_thai, 'type' => $ma_loai_bau_vat]);
	}

    public function view_tim_kiem_sp_chest($keyword,$type,$state,$page)
	{
		if (session('nguoi_dung') != null&& session('chuc_nang') == 'admin') {
			if($keyword != '\0') {
				if($type==0&&$state==-1){
					$tim_kiems = Bau_vat::where('ten_bau_vat','like','%'.$keyword. '%')->get();
				}
				elseif($type!=0&&$state==-1){
					$tim_kiems = Bau_vat::where('ten_bau_vat','like','%'.$keyword. '%',)
					->where('ma_loai_bau_vat','=',$type)->get();
				}
				elseif($type==0&&$state!=-1){
					$tim_kiems = Bau_vat::where('ten_bau_vat','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)->get();
				}
				else{
					$tim_kiems = Bau_vat::where('ten_bau_vat','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)
					->where('ma_loai_bau_vat','=',$type)->get();
				}
			}
			else{
				if($type==0&&$state==-1){
					$tim_kiems = Bau_vat::all();
				}
				elseif($type!=0&&$state==-1){
					$tim_kiems = Bau_vat::where('ma_loai_bau_vat','=',$type)->get();
				}
				elseif($type==0&&$state!=-1){
					$tim_kiems = Bau_vat::where('trang_thai','=',$state)->get();
				}
				else{
					$tim_kiems = Bau_vat::where('trang_thai','=',$state)
					->where('ma_loai_bau_vat','=',$type)->get();
				}
			}
			$loai_bau_vats = Loai_bau_vat::all();
			$data = [];
			$page_length = 6;
			// $all_tim_kiems = $tim_kiems->with(['tuong'])->get();
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
			$data['state'] = $state;
			$data['type'] = $type;
			$data['keyword'] = $keyword;
			return view('admin.Quan_ly_sp_chest.quan_ly_sp_chest_search', $data)->with('loai_bau_vats', $loai_bau_vats);
		} else {
            session()->flush();
			return redirect()->route('dang_nhap');
		}
	}
    public function xu_ly_them_chest(Request $request){
        $chest = new Bau_vat();
        $chest->ten_bau_vat = $request->ten_chest;
        $chest->ma_loai_bau_vat = $request->add_loai_bau_vat;
        $chest->trang_thai = $request->state;
        if ($request->hasFile('hinh_anh')) {
            $img = $request->hinh_anh;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
            //.move() mặc định ở public
            $img->move('chest', $imgname);
            $chest->hinh_anh = $imgname;
        } else {
            $chest->hinh_anh = "";
        }
        $chest->save();
        return redirect()->route('quan_ly_chest', 1);
    }
    public function xu_ly_sua_chest(Request $request){
        $chest = Bau_vat::find($request->ma_chest);
        $chest->ten_bau_vat = $request->up_ten_chest;
        $chest->ma_loai_bau_vat = $request->up_loai_bau_vat;
        $chest->trang_thai = $request->up_state;
        if ($request->hasFile('up_hinh_anh')) {
            $img = $request->up_hinh_anh;
            //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
            $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
            //.move() mặc định ở public
            $img->move('chest', $imgname);
            if(File::exists('chest/' . $chest->hinh_anh)){
                File::delete('chest/' . $chest->hinh_anh);
            }
            $chest->hinh_anh = $imgname;
        }
        $chest->save();
        return redirect()->route('quan_ly_chest', 1);
    }
    public function xu_ly_xoa_chest(Request $request){
        $chest = Bau_vat::find($request->ma_bau_vat);
        $chest->delete();
        if(File::exists('chest/' . $chest->hinh_anh)){
            File::delete('chest/' . $chest->hinh_anh);
        }
        return redirect()->route('quan_ly_chest', 1);
    }
/*----------------------------------------------------------------*/

public function view_quan_ly_sp_item($page)
{
    if (session('nguoi_dung') !=null && session('chuc_nang') == 'admin') {
        $loai_vat_phams = Loai_vat_pham::all();
        $data = [];
        $page_length = 6;
        $all_items = Vat_pham::all();
        $data['items'] =  $all_items->skip(($page - 1) * $page_length)->take($page_length);
        $page_number = (int)($all_items->count() / $page_length);
        if ($all_items->count() % $page_length > 0) {
            $page_number++;
        }
        $data['page_number'] = $page_number;
        $data['page'] = $page;
        return view('admin.Quan_ly_sp_item.quan_ly_sp_item', $data)->with('loai_vat_phams', $loai_vat_phams);
    } else {
        session()->flush();
        return redirect()->route('dang_nhap');
    }
}
public function xu_ly_tim_kiem_item(Request $request)
{
    $ten_vat_pham = $request->ten_vat_pham;
    $ma_loai_vat_pham = $request->loai_vat_pham;
    $trang_thai = $request->trang_thai;
    if($ten_vat_pham==null){
        $ten_vat_pham = '\0';
    }
    return redirect()->route('quan_ly_item_search',['page' => 1, 'keyword' => $ten_vat_pham, 'state' => $trang_thai, 'type' => $ma_loai_vat_pham]);
}

public function view_tim_kiem_sp_item($keyword,$type,$state,$page)
{
    if (session('nguoi_dung') !=null && session('chuc_nang') == 'admin') {
        if($keyword != '\0') {
            if($type==0&&$state==-1){
                $tim_kiems = Vat_pham::where('ten_vat_pham','like','%'.$keyword. '%')->get();
            }
            elseif($type!=0&&$state==-1){
                $tim_kiems = Vat_pham::where('ten_vat_pham','like','%'.$keyword. '%',)
                ->where('ma_loai_vat_pham','=',$type)->get();
            }
            elseif($type==0&&$state!=-1){
                $tim_kiems = Vat_pham::where('ten_vat_pham','like','%'.$keyword. '%',)
                ->where('trang_thai','=',$state)->get();
            }
            else{
                $tim_kiems = Vat_pham::where('ten_vat_pham','like','%'.$keyword. '%',)
                ->where('trang_thai','=',$state)
                ->where('ma_loai_vat_pham','=',$type)->get();
            }
        }
        else{
            if($type==0&&$state==-1){
                $tim_kiems = Vat_pham::all();
            }
            elseif($type!=0&&$state==-1){
                $tim_kiems = Vat_pham::where('ma_loai_vat_pham','=',$type)->get();
            }
            elseif($type==0&&$state!=-1){
                $tim_kiems = Vat_pham::where('trang_thai','=',$state)->get();
            }
            else{
                $tim_kiems = Vat_pham::where('trang_thai','=',$state)
                ->where('ma_loai_vat_pham','=',$type)->get();
            }
        }
        $loai_vat_phams = Loai_vat_pham::all();
        $data = [];
        $page_length = 6;
        // $all_tim_kiems = $tim_kiems->with(['tuong'])->get();
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
        $data['state'] = $state;
        $data['type'] = $type;
        $data['keyword'] = $keyword;
        return view('admin.Quan_ly_sp_item.quan_ly_sp_item_search', $data)->with('loai_vat_phams', $loai_vat_phams);
    } else {
        session()->flush();
        return redirect()->route('dang_nhap');
    }
}
public function xu_ly_them_item(Request $request){
    $item = new Vat_pham();
    $item->ten_vat_pham = $request->ten_item;
    $item->ma_loai_vat_pham = $request->add_loai_vat_pham;
    $item->trang_thai = $request->state;
    if ($request->hasFile('hinh_anh')) {
        $img = $request->hinh_anh;
        //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
        $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        //.move() mặc định ở public
        $img->move('item', $imgname);
        $item->hinh_anh = $imgname;
    } else {
        $item->hinh_anh = "";
    }
    $item->save();
    return redirect()->route('quan_ly_item', 1);
}
public function xu_ly_sua_item(Request $request){
    $item = Vat_pham::find($request->ma_item);
    $item->ten_vat_pham = $request->up_ten_item;
    $item->ma_loai_vat_pham = $request->up_loai_vat_pham;
    $item->trang_thai = $request->up_state;
    if ($request->hasFile('up_hinh_anh')) {
        $img = $request->up_hinh_anh;
        //Lấy thời gian upload nối với tên file xong mã hóa md5 rồi nối đuôi file
        $imgname = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        //.move() mặc định ở public
        $img->move('chest', $imgname);
        if(File::exists('item/' . $item->hinh_anh)){
            File::delete('item/' . $item->hinh_anh);
        }
        $item->hinh_anh = $imgname;
    }
    $item->save();
    return redirect()->route('quan_ly_item', 1);
}
    public function xu_ly_xoa_item(Request $request){
        $item = Bau_vat::find($request->ma_vat_pham);
        $item->delete();
        if(File::exists('item/' . $item->hinh_anh)){
            File::delete('item/' . $item->hinh_anh);
        }
        return redirect()->route('quan_ly_item', 1);
    }
/*----------------------------------------------------------------*/
    public function view_home_mua_trang_phuc()
    {
        $skins = Trang_phuc::where('trang_thai','=',1)->get();
        $nguoi_dung = session('nguoi_dung');
        $search = 0;
        return view('home.Mua_trang_phuc.mua_trang_phuc', ['skins' => $skins, 'nguoi_dung' => $nguoi_dung, 'search' => $search]);
    }
    public function xu_ly_tim_kiem_skin_home(Request $request)
	{
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
		$data['keyword'] = $request->keyword;
        $skins='';
        $data['search'] = 1;
        if($data['keyword'] != null){
            $skins = Trang_phuc::where('trang_thai','=',1)->where('ten_trang_phuc','like','%'.$data['keyword']. '%');
        }
        else{
            $skins = Trang_phuc::where('trang_thai','=',1);
        }
        $data['skins'] = $skins->get();
        // echo $tuongs->toSql();
		return view('home.Mua_trang_phuc.mua_trang_phuc', $data);
	}
    public function xu_ly_tim_kiem_skin_home_keyword(Request $request)
    {
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
		$data['keyword'] = $request->keyword;
        $tuong = Danh_sach_tuong::where('ten_tuong','like','%'.$data['keyword']. '%')->first();
        $data['ma_tuong'] = $tuong->ma_tuong;
        $skins='';
        $data['search'] = 1;
        $skins = Trang_phuc::where('trang_thai','=',1)->where('ma_tuong','=',$data['ma_tuong']);
        $data['skins'] = $skins->get();
        // echo $tuongs->toSql();
		return view('home.Mua_trang_phuc.mua_trang_phuc', $data);

    }
    public function view_chi_tiet_trang_phuc(Request $request){
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
        $data['keyword'] = $request->keyword;
        $data['skin'] = Trang_phuc::where('trang_thai','=',1)->where('ten_trang_phuc','like','%'.$data['keyword']. '%')->first();
        return view('home.Mua_trang_phuc.chi_tiet_trang_phuc', $data);
    }
    public function view_home_mua_bau_vat()
    {
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $chests = Bau_vat::where('trang_thai','=',1)->get();
        $nguoi_dung = session('nguoi_dung');
        $search = 0;
        return view('home.Mua_bau_vat.mua_bau_vat', ['chests' => $chests, 'nguoi_dung' => $nguoi_dung, 'search' => $search]);
    }
    public function xu_ly_tim_kiem_chest_home(Request $request)
	{
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
		$data['keyword'] = $request->keyword;
        $data['ruong'] = $request->ruong;
        $data['chia_khoa'] = $request->chia_khoa;
        $data['token'] = $request->token;
        $data['vien'] = $request->vien;
        $chests='';
        $inline = false;
        $data['search'] = 1;
        if($data['keyword'] != null){
            $chests = Bau_vat::where('trang_thai','=',1)->where('ten_bau_vat','like','%'.$data['keyword']. '%');
            $chests = $chests->where(function($query) use ($data, $inline){
            if($data['ruong']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['ruong']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['ruong']);
                    }
                }
                if($data['chia_khoa']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['chia_khoa']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['chia_khoa']);
                    }
                }
                if($data['vien']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['vien']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['vien']);
                    }
                }
                if($data['token']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['token']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['token']);
                    }
                } 
            });
        }
        else{
            $chests = Bau_vat::where('trang_thai','=',1);
            $chests = $chests->where(function($query) use ($data, $inline){
                if($data['ruong']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['ruong']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['ruong']);
                    }
                }
                if($data['chia_khoa']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['chia_khoa']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['chia_khoa']);
                    }
                }
                if($data['vien']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['vien']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['vien']);
                    }
                }
                if($data['token']!=null){
                    if($inline==false){
                        $query->where('ma_loai_bau_vat','=',$data['token']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_bau_vat','=',$data['token']);
                    }
                } 
            });
        }
        $data['chests'] = $chests->get();
        // echo $chests->toSql();
		return view('home.Mua_bau_vat.mua_bau_vat', $data);
	}
    public function view_home_mua_vat_pham()
    {
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $items = Vat_pham::where('trang_thai','=',1)->get();
        $nguoi_dung = session('nguoi_dung');
        $search = 0;
        return view('home.Mua_vat_pham.mua_vat_pham', ['items' => $items, 'nguoi_dung' => $nguoi_dung, 'search' => $search]);
    }
    public function xu_ly_tim_kiem_item_home(Request $request)
	{
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
		$data['keyword'] = $request->keyword;
        $data['mau_mat'] = $request->mau_mat;
        $data['emote'] = $request->emote;
        $items='';
        $inline = false;
        $data['search'] = 1;
        if($data['keyword'] != null){
            $items = Vat_pham::where('trang_thai','=',1)->where('ten_vat_pham','like','%'.$data['keyword']. '%');
            $items = $items->where(function($query) use ($data, $inline){
            if($data['mau_mat']!=null){
                if($inline==false){
                    $query->where('ma_loai_vat_pham','=',$data['mau_mat']);
                    $inline = true;
                }else{
                    $query->orwhere('ma_loai_vat_pham','=',$data['mau_mat']);
                }
            }
            if($data['emote']!=null){
                if($inline==false){
                    $query->where('ma_loai_vat_pham','=',$data['emote']);
                    $inline = true;
                }else{
                    $query->orwhere('ma_loai_vat_pham','=',$data['emote']);
                }
            }
            });
        }
        else{
            $items = Vat_pham::where('trang_thai','=',1);
            $items = $items->where(function($query) use ($data, $inline){
                if($data['mau_mat']!=null){
                    if($inline==false){
                        $query->where('ma_loai_vat_pham','=',$data['mau_mat']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_vat_pham','=',$data['mau_mat']);
                    }
                }
                if($data['emote']!=null){
                    if($inline==false){
                        $query->where('ma_loai_vat_pham','=',$data['emote']);
                        $inline = true;
                    }else{
                        $query->orwhere('ma_loai_vat_pham','=',$data['emote']);
                    }
                }
            });
        }
        $data['items'] = $items->get();
        // echo $items->toSql();
		return view('home.Mua_vat_pham.mua_vat_pham', $data);
	}

    public function view_chi_tiet_bau_vat(Request $request){
        if (session('chuc_nang') == 'admin') {
            session()->flush();
            return redirect()->route('dang_nhap');
        }
        $data = [];
        $data['nguoi_dung'] = session('nguoi_dung');
        $data['keyword'] = $request->keyword;
        $data['chest'] = Bau_vat::where('trang_thai','=',1)->where('ten_bau_vat','like','%'.$data['keyword']. '%')->first();
        return view('home.Mua_bau_vat.chi_tiet_bau_vat', $data);
    }
}
