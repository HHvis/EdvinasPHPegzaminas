<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patiekalas extends Model
{
    use HasFactory;

    protected $table = "patiekalai";
    protected $fillable = [
        'patiekalo_pavadinimas',
        'patiekalo_kaina',
        'patiekalo_aprasymas',
        'meniu_id',
    ];
}
