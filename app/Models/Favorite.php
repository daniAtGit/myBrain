<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favorite extends Model
{
    use HasUuids;

    protected $table="favorites";

    protected $fillable = [
        'id',
        'description'
    ];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function directories(): HasMany
    {
        return $this->hasMany(Link::class)->where('url',NULL)->where('title','!=',"");
    }
}
