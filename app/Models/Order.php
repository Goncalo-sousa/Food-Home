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

    public function users_prepared()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    
    public function users_delivered()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class,'id');
    }


}
