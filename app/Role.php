<?php

namespace App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PermitRole;
use App\RolePermit;

class Role extends Model
{
    //
    protected $fillable = [
        'name', 'display_name', 'description','id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(RolePermit::class, 'permission_role', 'role_id', 'permission_id');
    }

}
