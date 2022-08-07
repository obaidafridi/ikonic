<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConnection extends Model
{
    use HasFactory;
    Protected $guarded= [];

     //
    public function send_rquests()
    {
        return $this->belongsTo(User::class,'friend_id','id');
    }

    public function receive_rquests()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
