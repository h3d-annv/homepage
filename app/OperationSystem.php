<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationSystem extends Model
{
    protected $fillable=[
        'os_name'
    ];
    public function versions(){
        return $this->hasMany(Version::class);
    }
    public function logs(){
        return $this->hasMany(Log::class);
    }
}
