<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManutBrand extends Model
{
    use HasUuids;

    protected $table = 'manut_brands';

    protected $fillable = [
        'nome',
    ];

    public function oggetti() : HasMany
    {
        return $this->hasMany(ManutOggetto::class, 'brand_id', 'id');
    }
}
