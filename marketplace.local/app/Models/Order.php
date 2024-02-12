<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(
            Product::class)
            ->withPivot('color_id', 'size_id', "price", 'count');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
