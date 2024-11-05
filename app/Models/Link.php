<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasUuids;

    protected $table="links";

    protected $fillable = [
        'favorite_id',
        'index',
        'title',
        'url',
        'selfId',
        'parentId'
    ];

    protected $casts = [
        //'type' => TypeLink::class
    ];

    public function favorite(): BelongsTo
    {
        return $this->belongsTo(Favorite::class,'favorite_id','id');
    }

    public function underLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'parentId','selfId');
    }
}
