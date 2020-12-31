<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user)
    {
        // look into laravel collection and check the user id is with in the like model
        return $this->likes->contains('user_id', $user->id);
    }

    public function ownedBy(User $user)
    {
        return $user->id===$this->user_id;
    }

    public function user()
    {
        // define the relationship
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
