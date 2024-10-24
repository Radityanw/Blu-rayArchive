<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
class Rental extends Model
{
    use HasFactory;
    protected $table = 'rentals';
    protected $fillable = ['user_id', 'blurays_id', 'rented_at', 'due_date', 'status', 'fine'];
  
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bluray()
    {
        return $this->belongsTo(BluRay::class, 'blurays_id');
    }
    
}

