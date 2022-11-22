<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //

    public function images()
    {
        return $this->belongsToMany(Image::class);

    }



}
