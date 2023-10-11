<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
