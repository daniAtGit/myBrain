<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manutenzione extends Model
{
    use HasUuids;

    protected $table = 'manutenzioni';

    protected $fillable = [
        'oggetto_id',
        'fornitore_id',
        'data',
        'prezzo',
        'note',
    ];

    protected $casts = [
        'data' => 'date'
    ];

    public function oggetto(): BelongsTo
    {
        return $this->belongsTo(ManutOggetto::class, 'oggetto_id','id');
    }

    public function fornitore(): BelongsTo
    {
        return $this->belongsTo(ManutFornitore::class);
    }
}
