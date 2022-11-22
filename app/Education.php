<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = "educations";

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
