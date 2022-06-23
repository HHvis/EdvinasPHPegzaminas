<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meniu;
use App\Models\istaiga;

class viewMeniu extends Controller
{
    public function meniu($id)
    {
        return view('meniu', ['men' => meniu::where('maitinimo_istaigos_id', $id)->get(), 'ist' => istaiga::where('id', $id)->get(),]);
    }
}
