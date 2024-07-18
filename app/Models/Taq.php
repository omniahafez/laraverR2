<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taq extends Model
{
    use HasFactory;
    protected $fillable = [
        'taqName',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->beverages()->count() > 0) {
                throw new \Exception("Category cannot be deleted because it has associated beverages.");
            }
        });
    }
    public function beverages()
    {
        return $this->hasMany(Beverage::class)->where('published', 1);
    }
}
