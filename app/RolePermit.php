<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermit extends Model
{
    //
    protected  $table = "role_permissions";

    public function permission()
    {
        return $this->belongsTo(PermitRole::class,'id','role_id');
    }

}



