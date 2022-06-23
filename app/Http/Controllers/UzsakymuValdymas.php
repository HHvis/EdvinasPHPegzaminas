<?php

namespace App\Http\Controllers;
use App\Models\Uzsakymas;
use Illuminate\Http\Request;

class uzsakymuValdymas extends Controller
{
    public function priimtiUzsakyma(Request $request, $id)
    {
        $uzsak = Uzsakymas::findOrFail($id);

        if($uzsak){
            $uzsak->busena = 'paruoštas';
            $uzsak->save();
            return redirect()->back()->with('uzsakymas-accepted','Užsakymas paruoštas');
        }
    }

    public function atsauktiUzsakyma(Request $request, $id)
    {
        $uzsak = Uzsakymas::findOrFail($id);

        if($uzsak){
            $uzsak->busena = 'atšauktas';
            $uzsak->save();
            return redirect()->back()->with('uzsakymas-denied','Užsakymas atšauktas');
        }
    }


}
