<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function incrementViewCount()
    {
        $this->view++;
        $this->timestamps = false;
        return $this->save();
    }


    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
    public function comments()
    {
        return $this->hasMany(BookComment::class);
    }

}
