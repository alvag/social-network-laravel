<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static paginate()
 * @method static latest()
 */
class Status extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function isLiked(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
