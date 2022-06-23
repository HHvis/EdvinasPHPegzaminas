<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meniu;
use App\Models\istaiga;
use App\Models\patiekalas;

class viewPatiekalai extends Controller
{
    public function Patiekalai($id)
    {
        return view('patiekalai', ['pat' => patiekalas::where('meniu_id', $id)->get(),]);
    }
}
