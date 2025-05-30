<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'price',
        'rating',
        'availability',
        'status',
        'link',
        'image',
    ];

    protected $casts = [
        'availability' => 'boolean',
        'price' => 'float',
        'rating' => 'float',
    ];
public function images()
{
    return $this->hasMany(Image::class);
}

}
