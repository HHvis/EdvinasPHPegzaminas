<?php

namespace App\Http\Controllers;
use App\Models\knyga;
use Illuminate\Http\Request;

class knygaController extends Controller
{
    public function storeknyga(Request $request)
    {
        $kny = new knyga;
        $kny->knygos_pavadinimas = $request->input('kategorijos-pavadinimas');
        $kny->knygos_kaina = $request->input('kategorijos-kaina');
        $kny->knygos_aprasymas = $request->input('kategorijos-aprasymas');
        $kny->kategorija_id = $request->get('knyga-kategorija-id');

        if(empty($request->input('kategorijos-pavadinimas'))) 
        {
            return redirect()->back()->with('kategorijos-pavadinimas-failure','Įveskite knygos pavadinimą.');
        }

        if(empty($request->input('kategorijos-kaina'))) 
        {
            return redirect()->back()->with('kategorijos-kaina-failure','Įveskite knygos kainą.');
        }
  

        if(empty($request->input('kategorijos-aprasymas'))) 
        {
            return redirect()->back()->with('kategorijos-aprasymas-failure','Įveskite knygos aprašymą.');
        }

        if(empty($request->get('knyga-kategorija-id'))) 
        {
            return redirect()->back()->with('knyga-kategorija-id-failure','Pasirinkite kategoriją.');
        }

        $kny->save();
        return redirect()->back()->with('knyga-status','Knyga pateikta');
    }

    public function edit($id)
    {
        $kny = knyga::findOrFail($id); 
        return view('knygaRedagavimas', compact('kny'));    
    }

    public function update(Request $request, $id)
    {
      $kny = knyga::findOrFail($id);
      $kny->knygos_pavadinimas = $request->input('kategorijos-pavadinimas');
      $kny->knygos_kaina = $request->input('kategorijos-kaina');
      $kny->knygos_aprasymas = $request->input('kategorijos-aprasymas');

      if(empty($request->input('kategorijos-pavadinimas'))) 
      {
          return redirect()->back()->with('kategorijos-pavadinimas-failure','Įveskite knygos pavadinimą.');
      }

      if(empty($request->input('kategorijos-kaina'))) 
      {
          return redirect()->back()->with('kategorijos-kaina-failure','Įveskite knygos kainą.');
      }


      if(empty($request->input('kategorijos-aprasymas'))) 
      {
          return redirect()->back()->with('kategorijos-aprasymas-failure','Įveskite knygos aprašymą.');
      }

      $kny->update();
      return redirect()->back()->with('knyga-status','Knyga atnaujinta');
    }

    public function destroy($id)
    {
        $kny = knyga::findOrFail($id); 
        $kny->delete();
        return redirect()->back()->with('knyga-status','Knyga pašalinta');
    }
}
