<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Do_hiem extends Model
{
    use HasFactory;
    protected $table = 'do_hiem';
    public $incrementing = true;
    protected $primaryKey = 'ma_do_hiem';
    protected $keytype = 'int';
    public $timestamps = false;
    public function trang_phuc()
	{
        return $this->hasMany('App\Models\Trang_phuc', 'ma_do_hiem', 'ma_do_hiem');
	}
}
