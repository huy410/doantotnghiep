<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
    
    public $table = "order_detail";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function scopePopular($query)
    {
        return $query->select('*', $query->raw('SUM(quantity) as sum_quantity'))->groupBy('product_id')->orderByDesc('sum_quantity');
    }
}
