<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'operation_system_id','time','version_old','version_path_old','version_new','version_path_new','updated_by'
    ];
    public function operationSystem(){
        return $this->belongsTo(OperationSystem::class);
    }
}
