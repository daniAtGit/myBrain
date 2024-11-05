<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManutOggetto extends Model
{
    use HasUuids;

    protected $table = 'manut_oggetti';

    protected $fillable = [
        'categoria_id',
        'brand_id',
        'descrizione',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ManutBrand::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(ManutCategoria::class);
    }

    public function manutenzioni() : HasMany
    {
        return $this->hasMany(Manutenzione::class, 'oggetto_id', 'id');
    }
}
