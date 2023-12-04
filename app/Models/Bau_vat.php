<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bau_vat extends Model
{
    use HasFactory;
    protected $table = 'bau_vat';
    public $incrementing = true;
    protected $primaryKey = 'ma_bau_vat';
    protected $keytype = 'int';
    public $timestamps = false;
    public function loai_bau_vat()
	{
        return $this->hasOne('App\Models\Loai_bau_vat', 'ma_loai_bau_vat', 'ma_loai_bau_vat');
	}
}
