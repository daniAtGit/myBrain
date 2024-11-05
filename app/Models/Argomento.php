<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Argomento extends Model
{
    use HasUuids;

    protected $table="arguments";

    protected $fillable = [
        'argument',
        'color',
    ];

    protected $casts = [
//        'shipment_option' => 'array',
//        'shipment_date' => 'date',
//        'shipment_hour' => 'datetime',
//        'start' => 'datetime',
//        'end' => 'datetime',
    ];

    public function appunti()
    {
        return $this->hasMany(Appunto::class, 'argument_id', 'id');
    }
}
