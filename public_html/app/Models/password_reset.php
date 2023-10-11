<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_reset extends Model
{
    use HasFactory;
    public $table = "password_resets";
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
