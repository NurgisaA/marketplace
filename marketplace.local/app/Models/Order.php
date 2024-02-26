<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'state',
        'amount'
    ];
    public function product()
    {
        return $this->belongsToMany(
            Product::class, "product_order")
            ->withPivot('id', 'color_id', 'size_id', "price", 'count');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
