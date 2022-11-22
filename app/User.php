<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $primarykey = "id";


    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'id'
    ];

    protected $attributes = [

    ];

    public function education()
    {
        return $this->belongsTo('App\Education', 'edu_id');
    }

/*
    function book()
    {
        return $this->hasOne(Book::class);
    }
*/
    function avatar()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function books()
    {
        return $this->belongsTo(Book::class, 'id', 'created_by');
    }

    public function shelves()
    {
        return $this->belongsTo(shelf::class, 'id', 'created_by');

    }


    public function permissions()
    {
        return $this->belongsToMany(RolePermit::class);
    }


    public function comments()
    {
        return $this->belongsToMany(BookComment::class);
    }




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
}
