<?php
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function () {return view('pagrindinis');});
Route::get('/', [App\Http\Controllers\viewIstaigos::class, 'istaigos']);
Route::get('/admin_dashboard', [App\Http\Controllers\administratorius\DashboardController::class, 'index'])->middleware('role:administratorius');
Route::get('/user_dashboard', [App\Http\Controllers\vartotojas\DashboardController::class, 'index'])->middleware('role:vartotojas');
Route::post('/admin_dashboard/knygynoistaigos', [App\Http\Controllers\istaigaController::class, 'store']);
Route::post('/admin_dashboard/kategorija', [App\Http\Controllers\kategorijaController::class, 'storekategorija']);
Route::post('/admin_dashboard/knygos', [App\Http\Controllers\knygaController::class, 'storeknyga']);
Route::get('/redaguoti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'destroy'])->middleware('role:administratorius');
Route::put('atnaujinti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'update']);
Route::get('/redaguoti-kategorija/{id}', [App\Http\Controllers\kategorijaController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-kategorija/{id}', [App\Http\Controllers\kategorijaController::class, 'destroy'])->middleware('role:administratorius');
Route::put('/atnaujinti-kategorija/{id}', [App\Http\Controllers\kategorijaController::class, 'update']);
Route::get('/redaguoti-knyga/{id}', [App\Http\Controllers\knygaController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-knyga/{id}', [App\Http\Controllers\knygaController::class, 'destroy'])->middleware('role:administratorius');
Route::put('/atnaujinti-knyga/{id}', [App\Http\Controllers\knygaController::class, 'update']);
Route::get('/istaiga/{id}', [App\Http\Controllers\viewkategorija::class, 'kategorija']);
Route::get('/kategorija/{id}', [App\Http\Controllers\viewknygos::class, 'knygos']);
Route::post('/pirkti-knyga/{id}', [App\Http\Controllers\uzsakymasController::class, 'storeUzsakymas'])->middleware('role:vartotojas');
Route::get('/user_dashboard', [App\Http\Controllers\uzsakymasController::class, 'uzsakymai'])->middleware('role:vartotojas');
Route::post('/priimti-uzsakyma/{id}', [App\Http\Controllers\uzsakymuValdymas::class, 'priimtiUzsakyma']);
Route::post('/atsaukti-uzsakyma/{id}', [App\Http\Controllers\uzsakymuValdymas::class, 'atsauktiUzsakyma']);