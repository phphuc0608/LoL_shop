<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trang_phuc extends Model
{
    use HasFactory;
    protected $table = 'trang_phuc';
    public $incrementing = true;
    protected $primaryKey = 'ma_trang_phuc';
    protected $keytype = 'int';
    public $timestamps = false;
    public function do_hiem()
	{
        return $this->hasOne('App\Models\Do_hiem', 'ma_do_hiem', 'ma_do_hiem');
	}
    public function dong_skin()
	{
        return $this->hasOne('App\Models\Dong_skin', 'ma_dong_skin', 'ma_dong_skin');
	}
    public function ds_tuong()
	{
        return $this->hasOne('App\Models\Danh_sach_tuong', 'ma_tuong', 'ma_tuong');
	}
}
