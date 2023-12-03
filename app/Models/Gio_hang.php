<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gio_hang extends Model
{
    use HasFactory;
    protected $table = 'gio_hang';
    public $incrementing = true;
    protected $primaryKey = 'ma_gio_hang';
    protected $keytype = 'int';
    public $timestamps = false;
    public function khach_hang()
	{
        return $this->hasOne('App\Models\Khach_hang', 'ma_gio_hang', 'ma_gio_hang');
	}
}
