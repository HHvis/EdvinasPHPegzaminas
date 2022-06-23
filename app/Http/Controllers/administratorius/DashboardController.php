<?php

namespace App\Http\Controllers\administratorius;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\istaiga;
use App\Models\meniu;
use App\Models\patiekalas;
use App\Models\Uzsakymas;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
      }
      public function index() {
        $istaig = istaiga::all();
        $men = meniu::all();
        $pat = patiekalas::all();
        $uzsak = Uzsakymas::all();
        return view('administratorius.dashboard', compact('istaig', 'men', 'pat', 'uzsak'));
      }
}
