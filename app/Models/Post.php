<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image_path',
    ];
    // ✅ Relation : un post a plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // ✅ Relation : un post peut avoir plusieurs likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // (facultatif) un post appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}