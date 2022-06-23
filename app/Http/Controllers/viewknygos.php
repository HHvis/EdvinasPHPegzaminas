<?php

namespace App\Http\Controllers;
use App\Models\knyga;

class viewknygos extends Controller
{
    public function knygos($id)
    {
        return view('knygos', ['kny' => knyga::where('kategorija_id', $id)->get(),]);
    }
}
