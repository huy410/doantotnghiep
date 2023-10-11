<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersVerify extends Model
{
    use HasFactory;
    public $table = "users_verify";
    
    protected $fillable = [
        'customer_id',
        'token',
    ];
  
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
