<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongKe extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'thong_ke';
    public $guarded = [];
}
