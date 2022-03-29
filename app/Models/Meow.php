<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meow
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Meow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meow whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meow whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 */
class Meow extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    /**
     * Get the User who owns this Meow
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * All tags associated with Meow
     *
     * @return Tag[]
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
