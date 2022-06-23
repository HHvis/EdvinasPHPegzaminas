<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymas extends Model
{
    use HasFactory;

    protected $table = "uzsakymai";
    protected $fillable = [
        'knygos_id',
        'kiekis',
        'vartotojo_id',
        'busena',
    ];

    public function knyga()
    {
        return $this->belongsTo('App\Models\knyga');
    }

}
