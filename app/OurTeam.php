<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    protected $fillable  = [
    'name','roll_vi', 'roll_en','image', 'created_by','updated_by','is_active', 'is_deleted'
];
}
