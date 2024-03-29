<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'nif',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', "id");
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
