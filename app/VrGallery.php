<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrGallery extends Model
{
    protected $table = 'vr_gallery';

    public $timestamps = true;

    protected $fillable = [
        'image', 'link', 'sort', 'is_active', 'created_by', 'updated_by'
    ];
}
