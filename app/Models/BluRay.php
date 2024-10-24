<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class BluRay extends Model
{
    use HasFactory;
protected $table = 'blurays';
    protected $fillable = ['title','status', "image", "price", "description"];
    public function rentals()
    {
        return $this->hasMany(Rental::class, 'blurays_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blu_ray_category', 'blurays_id', 'category_id');
    }
}
