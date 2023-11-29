<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Danh_sach_tuong_controller extends Controller
{
    public function view_quan_ly_danh_sach_tuong()
    {
        return view('admin.Quan_ly_danh_sach_tuong.quan_ly_danh_sach_tuong');
    }
}
