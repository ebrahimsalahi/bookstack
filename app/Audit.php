<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
class Audit extends Model
{
    //

    protected $table = "audit_log";
    protected $fillable = [
        'ip', 'user_id', 'event', 'ip',
    ];

}
