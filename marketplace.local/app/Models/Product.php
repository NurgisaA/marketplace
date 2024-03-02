<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $perPage = 12;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'image',
    ];

    public function getImageUrl()
    {
        if (!$this->image) {
            return null;
        }
        return config('app.url') . Storage::url($this->image);
    }

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
        return $this->belongsToMany(Order::class, "product_order");
    }
}
