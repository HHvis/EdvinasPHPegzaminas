<?php

namespace App\Http\Controllers;
use App\Models\Uzsakymas;
use Illuminate\Http\Request;
use App\Models\patiekalas;
use Illuminate\Support\Facades\Auth;

class uzsakymasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
      }

    public function storeUzsakymas(Request $request, $id)
    {
        $pat = patiekalas::findOrFail($id);

        $uzsak = new Uzsakymas();

        $uzsak->patiekalo_id = $pat->id;
        $uzsak->kiekis = $request->input('kiekis');
        $uzsak->vartotojo_id = Auth::id();

        if(empty($request->input('kiekis'))) 
        {
            return redirect()->back()->with('patiekalo-kiekis-failure','Įveskite patiekalo kieki.');
        }


        $uzsak->save();
        return redirect()->back()->with('uzsakymas-status','Patiekalas užsakytas.');
    }

    public function uzsakymai()
    {
        return view('vartotojas.dashboard', ['uzsak' => Uzsakymas::where('vartotojo_id', Auth::id())->get(),]);
    }
}
