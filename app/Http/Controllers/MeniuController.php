<?php

namespace App\Http\Controllers;

use App\Models\Meniu;
use Illuminate\Http\Request;

class meniuController extends Controller
{

    
    public function __construct() {
        $this->middleware('auth');
      }
      public function storeMeniu(Request $request)
      {
          $men = new Meniu;
          $men->pavadinimas = $request->input('meniu-pavadinimas');
          $men->maitinimo_istaigos_id = $request->get('maitinimo-istaigos-id');
  
          if(empty($request->input('meniu-pavadinimas'))) 
          {
              return redirect()->back()->with('meniu-pavadinimas-failure','Įveskite meniu pavadinimą.');
          }
    
          if(empty($request->get('maitinimo-istaigos-id'))) 
          {
              return redirect()->back()->with('maitinimo-istaigos-id-failure','Pasirinkite maitinimo įstaigą.');
          }

          $men->save();
          return redirect()->back()->with('meniu-status','Meniu pateikta');
      }

      public function edit($id)
      {
          $men = meniu::findOrFail($id); 
          return view('meniuRedagavimas', compact('men'));    
      }

      public function update(Request $request, $id)
      {
        $men = meniu::findOrFail($id);
        $men->pavadinimas = $request->input('meniu-pavadinimas');

        if(empty($request->input('meniu-pavadinimas'))) 
        {
            return redirect()->back()->with('meniu-pavadinimas-failure','Įveskite meniu pavadinimą.');
        }
  
        $men->update();
        return redirect()->back()->with('meniu-status','Meniu atnaujinta');
      }

      public function destroy($id)
      {
          $men = meniu::findOrFail($id); 
          $men->delete();
          return redirect()->back()->with('meniu-status','Meniu pašalinta');
      }

}
