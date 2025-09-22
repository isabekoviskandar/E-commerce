<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = 
    [
        'name_uz',
        'name_ru',
        'name_eng',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
