<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat_pham extends Model
{
    use HasFactory;
    protected $table = 'vat_pham';
    public $incrementing = true;
    protected $primaryKey = 'ma_vat_pham';
    protected $keytype = 'int';
    public $timestamps = false;
    public function loai_vat_pham()
	{
        return $this->hasOne('App\Models\Loai_vat_pham', 'ma_loai_vat_pham', 'ma_loai_vat_pham');
	}
}
