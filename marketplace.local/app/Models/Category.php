<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getImageUrl()
    {
        if (!$this->image){
            return null;
        }
        return config('app.url') . Storage::url($this->image);
    }

}
