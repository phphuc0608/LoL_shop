<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai_vat_pham extends Model
{
    use HasFactory;
    protected $table = 'loai_vat_pham';
    public $incrementing = true;
    protected $primaryKey = 'ma_loai_vat_pham';
    protected $keytype = 'int';
    public $timestamps = false;
    public function vat_pham()
	{
        return $this->hasMany('App\Models\Vat_pham', 'ma_loai_vat_pham', 'ma_loai_vat_pham');
	}
}
