<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khach_hang extends Model
{
    use HasFactory;
    protected $table = 'khach_hang';
    public $incrementing = true;
    protected $primaryKey = 'ma_khach_hang';
    protected $keytype = 'string';
    public $timestamps = false;
    public function nguoi_dung()
	{
        return $this->hasOne('App\Models\Nguoi_dung', 'tai_khoan', 'tai_khoan');
	}
    public function gio_hang()
	{
        return $this->hasOne('App\Models\Gio_hang', 'ma_gio_hang', 'ma_gio_hang');
	}
    public function lich_su_mua_hang()
	{
        return $this->hasOne('App\Models\Lich_su_mua_hang', 'ma_ls_mua_hang', 'ma_ls_mua_hang');
	}
}
