<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function slides()
    {
        return $this->belongsToMany(Slide::class);

    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function shelves()
    {
        return $this->belongsTo(Shelf::class);
    }
}
