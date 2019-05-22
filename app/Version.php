<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable=[
        'operation_system_id','version', 'version_path','description','author','is_active'
    ];
    public function operationSystem(){
        return $this->belongsTo(OperationSystem::class);
    }
}
