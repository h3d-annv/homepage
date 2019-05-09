<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public $timestamps = true;

    protected $fillable = [
        'title_vi', 'title_en', 'slug', 'image', 'description_vi', 'description_en', 'content_vi', 'content_en', 'is_active', 'category_id'
    ];
}
