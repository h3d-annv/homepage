<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $fillable  = [
        'title_vi', 'title_en', 'content_vi', 'content_en','image', 'created_by','updated_by','is_active', 'is_deleted'
    ];
}
