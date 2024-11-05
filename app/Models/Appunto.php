<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Appunto extends Model
{
    use HasUuids;

    protected $table="lessons";

    protected $fillable = [
        'argument_id',
        'title',
        'lesson'
    ];

    public function argomento()
    {
        return $this->belongsTo(Argomento::class, 'argument_id', 'id');
    }
}
