<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    public $timestamps = true;

    protected $fillable = [
        'id', 'title_vi', 'title_en', 'slug', 'image', 'description_vi', 'description_en', 'is_active'
    ];
}
