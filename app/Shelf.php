<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    //
    protected $table = "bookshelves";

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    function book()
    {
        return $this->hasOne(Book::class,'id','book_id');

    }


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
