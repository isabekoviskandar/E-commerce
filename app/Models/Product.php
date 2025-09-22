<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =
    [
        'category_id',
        'name_uz',
        'name_ru',
        'name_eng',
        'description_uz',
        'description_ru',
        'description_eng',
        'country_uz',
        'country_ru',
        'country_eng',
        'composition_uz',
        'composition_ru',
        'composition_eng',
        'count',
        'price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
