<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dong_skin extends Model
{
    use HasFactory;
    protected $table = 'dong_skin';
    public $incrementing = true;
    protected $primaryKey = 'ma_dong_skin';
    protected $keytype = 'int';
    public $timestamps = false;
    public function trang_phuc()
	{
        return $this->hasMany('App\Models\Trang_phuc', 'ma_dong_skin', 'ma_dong_skin');
	}
}
