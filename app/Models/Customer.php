<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CustomerFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;
     protected $fillable = [
        'name',
        'email',
        'password',
        'is_email_verified',
        'remember_token',
        'facebook_id'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
}
