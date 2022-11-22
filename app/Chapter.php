<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    public function book()
    {
        return $this->belongsToMany(Book::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }


}
