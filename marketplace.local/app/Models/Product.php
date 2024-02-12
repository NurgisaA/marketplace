<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $perPage = 12;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class);
    }

    public function size()
    {
        return $this->belongsToMany(Size::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
