<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
            'name',
            'type',
            'description',
            'price',
    
    ];

    public function product_id()
    {
        return $this->hasMany(Order_item::class);
    }
}
