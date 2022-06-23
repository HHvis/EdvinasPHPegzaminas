<?php

namespace App\Http\Controllers;
use App\Models\Istaiga;

class viewIstaigos extends Controller
{
    public function istaigos(){
        $knygynas = Istaiga::all();
        return view('pagrindinis', compact('knygynas'));
      }
}
