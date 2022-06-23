<?php

namespace App\Http\Controllers;

use App\Models\kategorija;
use Illuminate\Http\Request;

class kategorijaController extends Controller
{

    
    public function __construct() {
        $this->middleware('auth');
      }
      public function storekategorija(Request $request)
      {
          $kat = new kategorija;
          $kat->pavadinimas = $request->input('kategorija-pavadinimas');
          $kat->knygu_istaigos_id = $request->get('knygyno-istaigos-id');
  
          if(empty($request->input('kategorija-pavadinimas'))) 
          {
              return redirect()->back()->with('kategorija-pavadinimas-failure','Įveskite kategorija pavadinimą.');
          }
    
          if(empty($request->get('knygyno-istaigos-id'))) 
          {
              return redirect()->back()->with('knygyno-istaigos-id-failure','Pasirinkite knygyną.');
          }

          $kat->save();
          return redirect()->back()->with('kategorija-status','kategorija pateikta');
      }

      public function edit($id)
      {
          $kat = kategorija::findOrFail($id); 
          return view('kategorijaRedagavimas', compact('kat'));    
      }

      public function update(Request $request, $id)
      {
        $kat = kategorija::findOrFail($id);
        $kat->pavadinimas = $request->input('kategorija-pavadinimas');

        if(empty($request->input('kategorija-pavadinimas'))) 
        {
            return redirect()->back()->with('kategorija-pavadinimas-failure','Įveskite kategorijos pavadinimą.');
        }
  
        $kat->update();
        return redirect()->back()->with('kategorija-status','Kategorija atnaujinta');
      }

      public function destroy($id)
      {
          $kat = kategorija::findOrFail($id); 
          $kat->delete();
          return redirect()->back()->with('kategorija-status','Kategorija pašalinta');
      }

}
