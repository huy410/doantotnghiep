<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'checked',
        'name',
    ];
    public $table = "notification_admins";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
