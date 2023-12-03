<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lich_su_mua_hang extends Model
{
    use HasFactory;
    protected $table = 'lich_su_mua_hang';
    public $incrementing = true;
    protected $primaryKey = 'ma_ls_mua_hang';
    protected $keytype = 'int';
    public $timestamps = false;
    public function khach_hang()
	{
        return $this->hasOne('App\Models\Khach_hang', 'ma_ls_mua_hang', 'ma_ls_mua_hang');
	}
}
