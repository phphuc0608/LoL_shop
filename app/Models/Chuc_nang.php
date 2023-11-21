<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chuc_nang extends Model
{
    use HasFactory;
    protected $table = 'chuc_nang';
    public $incrementing = true;
    protected $primaryKey = 'ma_chuc_nang';
    protected $keytype = 'int';
    public $timestamps = false;
    public function nguoi_dungs()
	{
        return $this->hasMany('App\Models\Nguoi_dung', 'ma_chuc_nang', 'ma_chuc_nang');
	}
}
