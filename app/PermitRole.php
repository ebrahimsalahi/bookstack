<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RolePermit;
class PermitRole extends Model
{
    //
    
    protected $table = "permission_role";
    public $timestamps = false;

    public function permission()
    {
        return $this->belongsToMany(RolePermit::class,'permission_id','permission_id');
    }

}
