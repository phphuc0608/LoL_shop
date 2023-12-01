<?php

namespace App\Http\Controllers;

use App\Models\Nguoi_dung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chuc_nang;
use App\Models\Khach_hang;
use PhpParser\Node\Stmt\ElseIf_;

class Nguoi_dung_controller extends Controller
{
    public function view_dang_nhap()
    {
        $data=[];
        $data['bao_loi'] = session('bao_loi');
        return view('admin.Dang_nhap.dang_nhap',$data);
    }
    public function xu_ly_dang_nhap(Request $request){
        $tai_khoan = $request->tai_khoan;
        $mat_khau = md5($request->mat_khau);
        $nguoi_dungs = Nguoi_dung::where('tai_khoan', '=', $tai_khoan);
        session()->put('bao_loi', '');
        if ($nguoi_dungs->count() == 0) {
            session()->put('bao_loi', 'Tài khoản không tồn tại');
        } else {
            $nguoi_dung = $nguoi_dungs->first();
            if ($nguoi_dung->mat_khau != $mat_khau) {
                session()->put('bao_loi', 'Sai mật khẩu');
            } else {
                session()->put('bao_loi', '');
                session()->put('nguoi_dung', $tai_khoan);
                if($nguoi_dung->ma_chuc_nang != 3) {
					session()->put('chuc_nang', 'customer');
				}
				else {
					session()->put('chuc_nang', 'admin');
				}
            }
        }
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
			$page_length = 6;
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
    public function xu_ly_them(Request $request)
	{
		$nguoi_dung = new Nguoi_dung();
		$nguoi_dung->tai_khoan = $request->username;
		$nguoi_dung->mat_khau = md5($request->password);
		$nguoi_dung->ma_chuc_nang = 2;
		$nguoi_dung->trang_thai = $request->state;
		$nguoi_dung->save();
		return redirect()->route('quan_ly_nguoi_dung', 1);
	}
    public function view_dang_ky()
    {
        return view('admin.Dang_ky.dang_ky');
    }
    public function xu_ly_dang_ky(Request $request)
	{
		$nguoi_dung = new Nguoi_dung();
        $khach_hang = new Khach_hang();
        $khach_hang->email = $request->email;
		$nguoi_dung->tai_khoan = $request->tai_khoan;
        $khach_hang->tai_khoan = $request->tai_khoan;
		$nguoi_dung->mat_khau = md5($request->mat_khau);
		$nguoi_dung->ma_chuc_nang = 3;
		$nguoi_dung->trang_thai = 1;
		$nguoi_dung->save();
        $khach_hang->save();
		return redirect()->route('dang_nhap');
	}
	public function xu_ly_tim_kiem(Request $request)
	{
		$ten_tai_khoan = $request->ten_tai_khoan;
		$trang_thai = $request->trang_thai;
		$chuc_nang = $request->chuc_nang;
		if($ten_tai_khoan!=null){
			$hasKey = 1;
			return redirect()->route('quan_ly_nguoi_dung_search_keyword',['page' => 1, 'keyword' => $ten_tai_khoan, 'state' => $trang_thai, 'pos' => $chuc_nang, 'hasKey' => $hasKey]);
		}
		else{
			$hasKey = 0;
			return redirect()->route('quan_ly_nguoi_dung_search',['page' => 1, 'state' => $trang_thai, 'pos' => $chuc_nang, 'hasKey' => $hasKey]);
		}
	}
    public function view_tim_kiem_keyword($page,$keyword,$state,$pos,$hasKey)
	{
		if (session('nguoi_dung') != null) {
			if($pos==0&&$state==-1){
				$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%')->get();
			}
			elseif($pos!=0&&$state==-1){
				$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)->where('ma_chuc_nang','=',$pos)->get();
			}
			elseif($pos==0&&$state!=-1){
				$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)->where('trang_thai','=',$state)->get();
			}
			else{
				$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)->where('trang_thai','=',$state)->where('ma_chuc_nang','=',$pos)->get();
			}
			$chuc_nangs = Chuc_nang::all();
			$data = [];
			$page_length = 6;
			// $all_nguoi_dungs = Nguoi_dung::with(['chuc_nang'])->get();
			$data['tim_kiems'] =  $tim_kiems->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($tim_kiems->count() / $page_length);
			if ($tim_kiems->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung_search', $data)->with('chuc_nangs', $chuc_nangs)->with('keyword',$keyword)->with('state',$state)->with('pos',$pos)->with('hasKey',$hasKey);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
	public function view_tim_kiem($page,$state,$pos,$hasKey)
	{
		if (session('nguoi_dung') != null) {
			if($pos==0&&$state==-1){
				$tim_kiems = Nguoi_dung::all();
			}
			elseif($pos!=0&&$state==-1){
				$tim_kiems = Nguoi_dung::where('ma_chuc_nang','=',$pos)->with(['chuc_nang'])->get();
			}
			elseif($pos==0&&$state!=-1){
				$tim_kiems = Nguoi_dung::where('trang_thai','=',$state)->with(['chuc_nang'])->get();
			}
			else{
				$tim_kiems = Nguoi_dung::where('trang_thai','=',$state)->where('ma_chuc_nang','=',$pos)->with(['chuc_nang'])->get();
			}
			$chuc_nangs = Chuc_nang::all();
			$data = [];
			$page_length = 6;
			// $all_tim_kiems = $tim_kiems->with(['chuc_nang'])->get();
			$data['tim_kiems'] =  $tim_kiems->skip(($page - 1) * $page_length)->take($page_length);
			$page_number = (int)($tim_kiems->count() / $page_length);
			if ($tim_kiems->count() % $page_length > 0) {
				$page_number++;
			}
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung_search', $data)->with('chuc_nangs', $chuc_nangs)->with('state',$state)->with('pos',$pos)->with('hasKey',$hasKey);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
	public function xu_ly_xoa($tai_khoan){
		$nguoi_dung = Nguoi_dung::find($tai_khoan);
		$khach_hang = Khach_hang::where('tai_khoan','=',$tai_khoan)->first();
		$nguoi_dung->delete();
		if($khach_hang!=null){
			$khach_hang->delete();
		}
		return redirect()->route('quan_ly_nguoi_dung',1);
	}
	public function xu_ly_sua(Request $request){
        $nguoi_dung = Nguoi_dung::find($request->update_tk);
        $nguoi_dung->trang_thai = $request->update_state;
        $nguoi_dung->save();	
        return redirect()->route('quan_ly_nguoi_dung', 1);
    }
}
