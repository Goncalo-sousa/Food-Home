<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    public function product_id()
    {
        return $this->belongsTo(Product::class);
    }

    public function order_id()
    {
        return $this->belongsTo(Order::class);
    }
}
