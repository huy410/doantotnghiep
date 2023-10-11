<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishLists extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
    ];
    public $table = "wish_lists";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
