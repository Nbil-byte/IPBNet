<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'type',
        'found',
        'isOn_start',
        'isOn_end',
        'title',       // New column added to fillable
        'likes',       // New column added to fillable
    ];

    protected $dates = [
        'isOn_start',
        'isOn_end',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes')->withTimestamps();
    }

    // Di dalam model Post
    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
    
    public function getIsFollowingAttribute()
    {
        if (auth()->check()) {
            // Periksa apakah pengguna saat ini mengikuti pengguna yang membuat postingan
            return $this->user->followers->contains(auth()->id());
        }

        return false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
