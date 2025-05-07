<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // ✅ Relation : un like appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relation : un like appartient à un post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
