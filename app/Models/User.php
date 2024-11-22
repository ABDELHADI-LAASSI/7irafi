<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'role',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function infos()
    {
        return $this->hasOne(AdditionalInfo::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }

    // Define the relationship to Post through Save (for posts saved by the user)
    public function savedPosts()
    {
        return $this->belongsToMany(Post::class, 'saves');
    }

    public function rates()
    {
        return $this->hasMany(Rating::class , 'hirafi_id');
    }

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
        'password' => 'hashed',
    ];
    public function additionalInfos()
    {
        return $this->hasMany(AdditionalInfo::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    /**
     * Get all messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

}
