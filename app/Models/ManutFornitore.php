<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManutFornitore extends Model
{
    use HasUuids;

    protected $table = 'manut_fornitori';

    protected $fillable = [
        'nome',
        'telefono',
        'email',
        'note',
    ];

    public function manutenzioni() : HasMany
    {
        return $this->hasMany(Manutenzione::class, 'fornitore_id', 'id');
    }
}
