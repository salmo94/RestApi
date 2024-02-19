<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *  @property-read User $author
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;
    public const POST_STATUSES = [
        self::STATUS_PUBLISHED => 'published',
        self::STATUS_UNPUBLISHED => 'unpublished',
    ];

    /**
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class,'id','author_id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
