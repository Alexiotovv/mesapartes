<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () { return 'Hello World'; })->name('test');

Route::get('/api_ValidarEntidad', [SoapController::class, 'api_ValidarEntidad'])->name('api_ValidarEntidad');
Route::get('/api_CodigoUnicoOperacion', [SoapController::class, 'api_CodigoUnicoOperacion'])->name('api_CodigoUnicoOperacion');
Route::get('/api_TipoDocumento', [SoapController::class, 'api_TipoDocumento'])->name('api_TipoDocumento');

Route::post('/api_RecepcionarTramiteResponse', [SoapController::class, 'api_RecepcionarTramiteResponse'])->name('api_RecepcionarTramiteResponse');

