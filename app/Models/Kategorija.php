<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    use HasFactory;

    protected $table = "kategorija";
    protected $fillable = [
        'pavadinimas',
        'knygu_istaigos_id',
    ];
}

