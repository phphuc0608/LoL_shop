<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguoi_dung extends Model
{
    use HasFactory;
    protected $table = 'nguoi_dung';
    public $incrementing = false;
    protected $primaryKey = 'tai_khoan';
    protected $keytype = 'string';
    public $timestamps = false;
}
