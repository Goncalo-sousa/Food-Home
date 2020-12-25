<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_item()
    {
        return $this->hasMany(Order::class);
    }

    public function prepared_by()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    
    public function delivered_by()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function customer_id()
    {
        return $this->belongsTo(Customer::class,'id');
    }


}
