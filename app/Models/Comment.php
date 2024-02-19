<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *  @property-read User $author
 * @property-read Post $post
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'author_id',
        'post_id',
        'parent_id'
    ];

    /**
     * @return HasMany
     */
    public function parent(): HasMany
    {
        return $this->hasMany(Comment::class,'id','parent_id');
    }

    /**
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class,'id','author_id');
    }

    /**
     * @return HasOne
     */
    public function post(): HasOne
    {
        return $this->hasOne(Post::class,'id','post_id');
    }
}
