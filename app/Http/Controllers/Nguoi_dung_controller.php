<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Nguoi_dung_controller extends Controller
{
    public function view_dang_nhap()
    {
        return view('admin.Dang_nhap.dang_nhap');
    }
    public function view_quan_ly_nguoi_dung()
    {
        return view('admin.Quan_ly_nguoi_dung.quan_ly_nguoi_dung');
    }
}
