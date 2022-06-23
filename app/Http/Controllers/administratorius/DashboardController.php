<?php

namespace App\Http\Controllers\administratorius;

use App\Http\Controllers\Controller;
use App\Models\Istaiga;
use App\Models\Kategorija;
use App\Models\Knyga;
use App\Models\Uzsakymas;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
      }
      public function index() {
        $knygynas = Istaiga::all();
        $kat = Kategorija::all();
        $kny = Knyga::all();
        $uzsak = Uzsakymas::all();
        return view('administratorius.dashboard', compact('knygynas', 'kat', 'kny', 'uzsak'));
      }
}
