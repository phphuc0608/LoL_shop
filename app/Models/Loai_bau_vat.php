<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai_bau_vat extends Model
{
    use HasFactory;
    protected $table = 'loai_bau_vat';
    public $incrementing = true;
    protected $primaryKey = 'ma_loai_bau_vat';
    protected $keytype = 'int';
    public $timestamps = false;
    public function bau_vat()
	{
        return $this->hasMany('App\Models\Bau_vat', 'ma_loai_bau_vat', 'ma_loai_bau_vat');
	}
}
