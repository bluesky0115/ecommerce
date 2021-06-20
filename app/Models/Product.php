<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function carts()
    {
       return $this->belongsToMany(Cart::class); 
    }
    public function comments()
    {
      return $this->hasMany(Comment::class);  
    }
}
