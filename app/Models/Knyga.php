<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knyga extends Model
{
    use HasFactory;

    protected $table = "knygos";
    protected $fillable = [
        'knygos_pavadinimas',
        'knygos_kaina',
        'knygos_aprasymas',
        'kategorija_id',
    ];
}
