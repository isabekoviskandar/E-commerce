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
        'name_en',
        'description_uz',
        'description_ru',
        'description_en',
        'country_uz',
        'country_ru',
        'country_eng',
        'composition_uz',
        'composition_ru',
        'composition_en',
        'count',
        'price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale() === 'en' ? 'eng' : app()->getLocale();
        return $this->{'name_' . $locale};
    }
}
