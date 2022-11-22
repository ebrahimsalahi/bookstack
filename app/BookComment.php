<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    //
    protected $table = "comments";

    function book()
    {
        return $this->hasOne(Book::class,'id','book_id');

    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
