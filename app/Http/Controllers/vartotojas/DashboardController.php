<?php

namespace App\Http\Controllers\vartotojas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\istaiga;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
      }
      public function index() {
        return view('vartotojas.dashboard');
      }
}
