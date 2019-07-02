<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable  = [
        'title_vi', 'title_en', 'content_vi', 'content_en','icon', 'created_by','updated_by','is_active', 'is_deleted'
    ];
}
