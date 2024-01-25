<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
 
        static::addGlobalScope('commentCount', function ($builder) {
            $builder->withCount('comments');
        });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
