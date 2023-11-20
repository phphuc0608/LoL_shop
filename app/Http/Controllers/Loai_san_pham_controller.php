<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Loai_san_pham_controller extends Controller
{
    public function view_lsp()
    {
        return view('view_loai_san_pham');
    }
}
