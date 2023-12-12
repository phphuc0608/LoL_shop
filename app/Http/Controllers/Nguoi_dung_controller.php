<?php

namespace App\Http\Controllers;

use App\Models\Nguoi_dung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chuc_nang;
use App\Models\Khach_hang;
use App\Models\Gio_hang;
use App\Models\Lich_su_mua_hang;
use PhpParser\Node\Stmt\ElseIf_;

class Nguoi_dung_controller extends Controller
{
    public function view_dang_nhap()
    {
        $data=[];
        $data['bao_loi'] = session('bao_loi');
        return view('admin.Dang_nhap.dang_nhap',$data);
    }

	public function view_quen_mk()
    {
        $data=[];
        $data['bao_loi'] = session('bao_loi');
        return view('admin.Dang_nhap.quen_mk',$data);
    }
	public function xu_ly_quen_mk(Request $request){
        $tai_khoan = $request->tai_khoan;
        $mat_khau = md5($request->mat_khau);
		$re_mat_khau = md5($request->xac_nhan_mat_khau);
		
        $nguoi_dungs = Nguoi_dung::where('tai_khoan', '=', $tai_khoan)->where('trang_thai','=', 1);
		// $up_nguoi_dung = Nguoi_dung::find('tai_khoan');
        session()->put('bao_loi', '');
        if ($nguoi_dungs->count() == 0) {
            session()->put('bao_loi', 'Tài khoản không tồn tại');
			// return redirect()->route('quen_mk');
        } 
		else {
            $nguoi_dung = $nguoi_dungs->first();
			if($mat_khau!=$re_mat_khau){
				session()->put('bao_loi', 'Mật khẩu không khớp');
				// return redirect()->route('quen_mk');
			}
			else{
				if ($nguoi_dung->mat_khau == $mat_khau) {
                	session()->put('bao_loi', 'Mật khẩu mới trùng với mật khẩu cũ');
				// return redirect()->route('quen_mk');
				} 
				else {
					session()->put('bao_loi', '');
				}
			}
        }
        if (session('bao_loi') == '') {
			$nguoi_dung = $nguoi_dungs->first();
			$nguoi_dung->mat_khau = $mat_khau;
			$nguoi_dung->save();
			return redirect()->route('dang_nhap');
            
        } else {
            return redirect()->route('quen_mk');
        }
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
                if($nguoi_dung->ma_chuc_nang == 3) {
					session()->put('chuc_nang', 'customer');
				}
				else {
					session()->put('chuc_nang', 'admin');
				}
            }
        }
        if (session('bao_loi') == '') {
			if(session('chuc_nang') == 'customer') {
				return redirect()->route('home_ds_tuong');
			}
			else{
				return redirect()->route('quan_ly_nguoi_dung',1);
			}
            
        } else {
            return redirect()->route('dang_nhap');
        }
    }
		public function xu_ly_dang_xuat(){
			session()->flush();
			return redirect()->route('dang_nhap');
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
	public function xu_ly_tim_kiem(Request $request)
	{
		$ten_tai_khoan = $request->ten_tai_khoan;
		$trang_thai = $request->trang_thai;
		$chuc_nang = $request->chuc_nang;
		if($ten_tai_khoan==null){
			$ten_tai_khoan = '\0';
		}
		return redirect()->route('quan_ly_nguoi_dung_search',['page' => 1, 'keyword' => $ten_tai_khoan, 'state' => $trang_thai, 'pos' => $chuc_nang]);
	}

	public function view_tim_kiem($keyword,$state,$pos,$page)
	{
		if (session('nguoi_dung') != null) {
			if($keyword != '\0') {
				if($pos==0&&$state==-1){
					$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%')->get();
				}
				elseif($pos!=0&&$state==-1){
					$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)
					->where('ma_chuc_nang','=',$pos)->get();
				}
				elseif($pos==0&&$state!=-1){
					$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)->get();
				}
				else{
					$tim_kiems = Nguoi_dung::where('tai_khoan','like','%'.$keyword. '%',)
					->where('trang_thai','=',$state)
					->where('ma_chuc_nang','=',$pos)->get();
				}
			}
			else{
				if($pos==0&&$state==-1){
					$tim_kiems = Nguoi_dung::all();
				}
				elseif($pos!=0&&$state==-1){
					$tim_kiems = Nguoi_dung::where('ma_chuc_nang','=',$pos)
					->with(['chuc_nang'])->get();
				}
				elseif($pos==0&&$state!=-1){
					$tim_kiems = Nguoi_dung::where('trang_thai','=',$state)
					->with(['chuc_nang'])->get();
				}
				else{
					$tim_kiems = Nguoi_dung::where('trang_thai','=',$state)
					->where('ma_chuc_nang','=',$pos)
					->with(['chuc_nang'])->get();
				}
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
			if ($tim_kiems->count()==0) {
				$data['empty'] = 1;
			}
			else{
                $data['empty'] = 0;
            }
			$data['page_number'] = $page_number;
			$data['page'] = $page;
			$data['state'] = $state;
			$data['pos'] = $pos;
			$data['keyword'] = $keyword;
			return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung_search', $data)->with('chuc_nangs', $chuc_nangs);
		} else {
			return redirect()->route('dang_nhap');
		}
	}
	public function xu_ly_xoa($tai_khoan){
		$nguoi_dung = Nguoi_dung::find($tai_khoan);
		$khach_hang = Khach_hang::where('tai_khoan','=',$tai_khoan)->first();
		$nguoi_dung->delete();
		if($khach_hang!=null){
			$gio_hang = Gio_hang::where('ma_gio_hang','=',$khach_hang->ma_gio_hang)->first();
        	$lich_su_mua_hang = Lich_su_mua_hang::where('ma_ls_mua_hang','=',$khach_hang->ma_ls_mua_hang)->first();
			$khach_hang->delete();
			$gio_hang->delete();
        	$lich_su_mua_hang->delete();
		}
		return redirect()->route('quan_ly_nguoi_dung',1);
	}
	public function xu_ly_sua(Request $request){
        $nguoi_dung = Nguoi_dung::find($request->update_tk);
        $nguoi_dung->trang_thai = $request->update_state;
        $nguoi_dung->save();	
        return redirect()->route('quan_ly_nguoi_dung', 1);
    }
	/*---------------------- */
	public function view_thong_tin_tai_khoan(){
		if (session('nguoi_dung') != null) {
			$data = [];
			$data['bao_loi'] = session('bao_loi');
			$data['nguoi_dung'] = session('nguoi_dung');
			$data['khach_hang'] = Khach_hang::
				// joinRelationship('nguoi_dung')
				join('nguoi_dung','nguoi_dung.tai_khoan','=','khach_hang.tai_khoan')
				->where('trang_thai','=',1)
				->where('khach_hang.tai_khoan','like','%'.$data['nguoi_dung']. '%')
				// where('tai_khoan','like','%'.$data['nguoi_dung']. '%')
				// ->toSql();
				->first();
		}
		else{
            return redirect()->route('home_ds_tuong');
        }
		// echo $data['khach_hang'];
		// echo $data['nguoi_dung'];
		return view('home.Tai_khoan.thong_tin_tai_khoan', $data);
	}
	public function xu_ly_cap_nhat_khach_hang(Request $request){
        $nguoi_dung = Nguoi_dung::find($request->tai_khoan);
		$khach_hang = Khach_hang::where('tai_khoan','=',$request->tai_khoan)->first();
		session()->put('bao_loi', '');
		if(isset($request->email)){
			$khach_hang->email = $request->email;
			$khach_hang->save();
			session()->put('bao_loi', '');
		}
		else{
			session()->put('bao_loi', 'Bạn chưa nhập email');
		}
		if(isset($request->mat_khau)||isset($request->xac_nhan_mat_khau)){
			if($request->xac_nhan_mat_khau==$request->mat_khau){
				$nguoi_dung->mat_khau = md5($request->mat_khau);
				$nguoi_dung->save();
				session()->put('bao_loi', '');
			}
			else{
				session()->put('bao_loi', 'Xác nhận mật khẩu không khớp.');
			}
		}
		// echo $khach_hang;
        return redirect()->route('thong_tin_tai_khoan');
    }
}

