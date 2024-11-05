<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManutCategoria extends Model
{
    use HasUuids;

    protected $table = 'manut_categorie';

    protected $fillable = [
        'nome',
    ];

    public function oggetti() : HasMany
    {
        return $this->hasMany(ManutOggetto::class, 'categoria_id', 'id');
    }
}
