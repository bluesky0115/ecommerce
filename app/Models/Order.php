<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongstoMany(User::class)->withPivot(['quantity']);
    }
    public function products()
    {
        return $this->belongsToManyOrder(Product::class);
    }

}
