<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thong_ke extends Model
{
    use HasFactory;
    protected $table = 'thong_ke';
    public $incrementing = false;
    protected $primaryKey = 'thang';
    protected $keytype = 'string';
    public $timestamps = false;
}
