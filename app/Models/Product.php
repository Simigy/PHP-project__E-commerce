<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'quantity',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id');
    }

    public function getIsFavoritedAttribute()
    {
        if (auth()->check()) {
            return $this->favorites()->where('user_id', auth()->id())->exists();
        }
        return false;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
