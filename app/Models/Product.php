<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'desc',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavorites()
    {
        return $this->favorites()->where('user_id', Auth::user()->id)->exists();
    }
}
