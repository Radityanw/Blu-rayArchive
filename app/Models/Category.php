<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function blurays()
    {
        return $this->belongsToMany(BluRay::class, 'blu_ray_category', 'category_id', 'blurays_id');
}
}


