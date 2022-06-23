<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meniu extends Model
{
    use HasFactory;

    protected $table = "meniu";
    protected $fillable = [
        'pavadinimas',
        'maitinimo_istaigos_id',
    ];
}

