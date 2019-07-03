<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    protected $table = 'changelog';

    public $timestamps = true;

    protected $fillable = [
        'id', 'version', 'changelog', 'created_by', 'updated_by'
    ];
}
