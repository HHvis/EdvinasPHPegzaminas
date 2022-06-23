<?php

namespace App\Http\Controllers;
use App\Models\patiekalas;
use Illuminate\Http\Request;

class patiekalasController extends Controller
{
    public function storePatiekalas(Request $request)
    {
        $pat = new patiekalas;
        $pat->patiekalo_pavadinimas = $request->input('patiekalo-pavadinimas');
        $pat->patiekalo_kaina = $request->input('patiekalo-kaina');
        $pat->patiekalo_aprasymas = $request->input('patiekalo-aprasymas');
        $pat->meniu_id = $request->get('patiekalas-meniu-id');

        if(empty($request->input('patiekalo-pavadinimas'))) 
        {
            return redirect()->back()->with('patiekalo-pavadinimas-failure','Įveskite patiekalo pavadinimą.');
        }

        if(empty($request->input('patiekalo-kaina'))) 
        {
            return redirect()->back()->with('patiekalo-kaina-failure','Įveskite patiekalo kainą.');
        }
  

        if(empty($request->input('patiekalo-aprasymas'))) 
        {
            return redirect()->back()->with('patiekalo-aprasymas-failure','Įveskite patiekalo aprašymą.');
        }

        if(empty($request->get('patiekalas-meniu-id'))) 
        {
            return redirect()->back()->with('patiekalas-meniu-id-failure','Pasirinkite meniu.');
        }

        $pat->save();
        return redirect()->back()->with('patiekalas-status','Patiekalas pateiktas');
    }

    public function edit($id)
    {
        $pat = patiekalas::findOrFail($id); 
        return view('patiekalasRedagavimas', compact('pat'));    
    }

    public function update(Request $request, $id)
    {
      $pat = patiekalas::findOrFail($id);
      $pat->patiekalo_pavadinimas = $request->input('patiekalo-pavadinimas');
      $pat->patiekalo_kaina = $request->input('patiekalo-kaina');
      $pat->patiekalo_aprasymas = $request->input('patiekalo-aprasymas');

      if(empty($request->input('patiekalo-pavadinimas'))) 
      {
          return redirect()->back()->with('patiekalo-pavadinimas-failure','Įveskite patiekalo pavadinimą.');
      }

      if(empty($request->input('patiekalo-kaina'))) 
      {
          return redirect()->back()->with('patiekalo-kaina-failure','Įveskite patiekalo kainą.');
      }


      if(empty($request->input('patiekalo-aprasymas'))) 
      {
          return redirect()->back()->with('patiekalo-aprasymas-failure','Įveskite patiekalo aprašymą.');
      }

      $pat->update();
      return redirect()->back()->with('patiekalas-status','Patiekalas atnaujintas');
    }

    public function destroy($id)
    {
        $pat = patiekalas::findOrFail($id); 
        $pat->delete();
        return redirect()->back()->with('patiekalas-status','Patiekalas pašalintas');
    }
}
