<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dang_nhap_controller extends Controller
{
    public function view_dang_nhap()
    {
        return view('admin.Dang_nhap.dang_nhap');
    }
}
