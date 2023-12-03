<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danh_sach_tuong extends Model
{
    use HasFactory;
    protected $table = 'ds_tuong';
    public $incrementing = true;
    protected $primaryKey = 'ma_tuong';
    protected $keytype = 'string';
    public $timestamps = false;
}
?>