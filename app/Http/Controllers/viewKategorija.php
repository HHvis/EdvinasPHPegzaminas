<?php

namespace App\Http\Controllers;
use App\Models\kategorija;
use App\Models\istaiga;

class viewkategorija extends Controller
{
    public function kategorija($id)
    {
        return view('kategorija', ['kat' => kategorija::where('knygu_istaigos_id', $id)->get(), 'ist' => istaiga::where('id', $id)->get(),]);
    }
}
