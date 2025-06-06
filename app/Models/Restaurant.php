<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
      'name', 'image','category_id', 'description', 'address', 'phone', 'email'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
   public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
