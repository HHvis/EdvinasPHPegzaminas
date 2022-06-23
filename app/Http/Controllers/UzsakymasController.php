<?php

namespace App\Http\Controllers;
use App\Models\Uzsakymas;
use Illuminate\Http\Request;
use App\Models\knyga;
use Illuminate\Support\Facades\Auth;

class uzsakymasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
      }

    public function storeUzsakymas(Request $request, $id)
    {
        $kny = knyga::findOrFail($id);

        $uzsak = new Uzsakymas();

        $uzsak->knygos_id = $kny->id;
        $uzsak->kiekis = $request->input('kiekis');
        $uzsak->vartotojo_id = Auth::id();

        if(empty($request->input('kiekis'))) 
        {
            return redirect()->back()->with('knygos-kiekis-failure','Įveskite knygos kiekį.');
        }


        $uzsak->save();
        return redirect()->back()->with('uzsakymas-status','Knyga užsakyta.');
    }

    public function uzsakymai()
    {
        return view('vartotojas.dashboard', ['uzsak' => Uzsakymas::where('vartotojo_id', Auth::id())->get(),]);
    }
}
