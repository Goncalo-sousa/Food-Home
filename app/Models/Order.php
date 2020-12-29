<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }

    public function prepared_by()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    public function cook()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    
    public function delivered_by()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
