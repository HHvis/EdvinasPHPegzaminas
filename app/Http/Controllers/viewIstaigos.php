<?php

namespace App\Http\Controllers;
use App\Models\Istaiga;

class viewIstaigos extends Controller
{
    public function istaigos(){
        $istaig = istaiga::all();
        return view('pagrindinis', compact('istaig'));
      }
}
