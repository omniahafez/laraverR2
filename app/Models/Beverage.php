<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'content',
        'price',
        'published',
        'special',
        'image',
        'taq_id',
    ];

    public function taq(){
        return $this->belongsTo(Taq::class);
      }
}
