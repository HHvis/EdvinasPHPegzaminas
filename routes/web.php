<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
      return view('pagrindinis');
});
Route::get('/', [App\Http\Controllers\viewIstaigos::class, 'istaigos']);
Auth::routes();
Route::get('/admin_dashboard', [App\Http\Controllers\administratorius\DashboardController::class, 'index'])->middleware('role:administratorius');
Route::get('/user_dashboard', [App\Http\Controllers\vartotojas\DashboardController::class, 'index'])->middleware('role:vartotojas');
Route::post('/admin_dashboard/maitinimoistaigos', [App\Http\Controllers\istaigaController::class, 'store']);
Route::post('/admin_dashboard/meniu', [App\Http\Controllers\meniuController::class, 'storeMeniu']);
Route::post('/admin_dashboard/patiekalai', [App\Http\Controllers\patiekalasController::class, 'storePatiekalas']);
Route::get('/redaguoti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'destroy'])->middleware('role:administratorius');
Route::put('atnaujinti-istaiga/{id}', [App\Http\Controllers\istaigaController::class, 'update']);
Route::get('/redaguoti-meniu/{id}', [App\Http\Controllers\meniuController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-meniu/{id}', [App\Http\Controllers\meniuController::class, 'destroy'])->middleware('role:administratorius');
Route::put('/atnaujinti-meniu/{id}', [App\Http\Controllers\meniuController::class, 'update']);
Route::get('/redaguoti-patiekala/{id}', [App\Http\Controllers\patiekalasController::class, 'edit'])->middleware('role:administratorius');
Route::get('/istrinti-patiekala/{id}', [App\Http\Controllers\patiekalasController::class, 'destroy'])->middleware('role:administratorius');
Route::put('/atnaujinti-patiekala/{id}', [App\Http\Controllers\patiekalasController::class, 'update']);
Route::get('/istaiga/{id}', [App\Http\Controllers\viewMeniu::class, 'meniu']);
Route::get('/meniu/{id}', [App\Http\Controllers\viewPatiekalai::class, 'patiekalai']);
Route::post('/pirkti-patiekala/{id}', [App\Http\Controllers\uzsakymasController::class, 'storeUzsakymas'])->middleware('role:vartotojas');
Route::get('/user_dashboard', [App\Http\Controllers\uzsakymasController::class, 'uzsakymai'])->middleware('role:vartotojas');
Route::post('/priimti-uzsakyma/{id}', [App\Http\Controllers\uzsakymuValdymas::class, 'priimtiUzsakyma']);
Route::post('/atsaukti-uzsakyma/{id}', [App\Http\Controllers\uzsakymuValdymas::class, 'atsauktiUzsakyma']);