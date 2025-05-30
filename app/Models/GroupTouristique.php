<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTouristique extends Model
{
    protected $fillable = [
    'title', 'description', 'duration', 'max_people', 'starting_point', 'price',
    'images', 'caravan_name', 'registration_link', 'social_media_links'
];


    protected $casts = [
        'caravan_name' => 'array',
        'images' => 'array',
        'social_media_links' => 'array',
        'price' => 'decimal:2',
    ];
}
