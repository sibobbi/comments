<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:h:i:s d.m.Y',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }
}
