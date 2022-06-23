<?php

namespace App\Http\Controllers;
use App\Models\Istaiga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class IstaigaController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
      }

    public function store(Request $request)
    {
        $ist = new Istaiga;
        $ist->pavadinimas = $request->input('pavadinimas');
        $ist->kodas = $request->input('kodas');
        $ist->adresas = $request->input('adresas');

        if(empty($request->input('pavadinimas'))) 
        {
            return redirect()->back()->with('pavadinimas-failure','Įveskite knygyno pavadinimą.');
        }

        if(empty($request->input('kodas'))) 
        {
            return redirect()->back()->with('kodas-failure','Įveskite knygyno kodą.');
        }

        if(empty($request->input('adresas'))) 
        {
            return redirect()->back()->with('adresas-failure','Įveskite knygyno adresą.');
        }

        if($request->hasfile('nuotrauka'))
        {
            $file = $request->file('nuotrauka');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('images/istaigos/', $filename);
            $ist->nuotrauka = $filename;
        } else {
            return redirect()->back()->with('photo-failure','Nepasirinkta nuotrauka'); 
        }

        $ist->save();
        return redirect()->back()->with('status','Knygynas pateiktas');
    }

    public function edit($id)
    {
        $ist = istaiga::findOrFail($id); 
        return view('istaigaRedagavimas', compact('ist'));    
    }

    public function update(Request $request, $id)
    {
        $ist = istaiga::findOrFail($id); 

        $ist->pavadinimas = $request->input('pavadinimas');
        $ist->kodas = $request->input('kodas');
        $ist->adresas = $request->input('adresas');

        if(empty($request->input('pavadinimas'))) 
        {
            return redirect()->back()->with('pavadinimas-failure','Įveskite knygyno pavadinimą.');
        }

        if(empty($request->input('kodas'))) 
        {
            return redirect()->back()->with('kodas-failure','Įveskite knygyno kodą.');
        }

        if(empty($request->input('adresas'))) 
        {
            return redirect()->back()->with('adresas-failure','Įveskite knygyno adresą.');
        }

        if($request->hasfile('nuotrauka'))
        {
            $destination = 'images/istaigos/' . $ist->nuotrauka;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('nuotrauka');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('images/istaigos/', $filename);
            $ist->nuotrauka = $filename;
        }

        $ist->update();
        return redirect()->back()->with('status','Knygynas atnaujintas');
    }


    public function destroy($id)
    {
        $ist = istaiga::findOrFail($id); 
        $destination = 'images/istaigos/' . $ist->nuotrauka;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $ist->delete();
        return redirect()->back()->with('status','Knygynas pašalintas');
    }
}
