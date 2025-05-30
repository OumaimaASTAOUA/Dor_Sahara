<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'price',
        'rating',
        'availability',
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
