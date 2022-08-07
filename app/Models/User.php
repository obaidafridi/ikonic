<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'user_connections', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }
 
    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'user_connections', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }


    public function acceptedFriendsTo()
    {
    return $this->friendsTo()->wherePivot('status', "connected");
    }

    public function acceptedFriendsFrom()
    {
    return $this->friendsFrom()->wherePivot('status', "connected");
    }

    public function friends()
    {
        return $this->acceptedFriendsFrom->merge($this->acceptedFriendsTo);
    }
    
    
}
