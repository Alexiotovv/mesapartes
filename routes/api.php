<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MesapartesController;
use App\Http\Controllers\TipoPersonasController;
use App\Http\Controllers\TipoDocumentosController;
use App\Http\Controllers\TipoDocumentosidentidadesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// //Users
// Route::middleware('jwt.auth')->post('/profile', function () { return auth()->user(); });
// Route::middleware('jwt.auth')->patch('/change_status/user/{id_user}', [UserController::class,'change_status']);
// Route::post('/register', [UserController::class,'register']);
Route::middleware('jwt.auth')->get('/users', [UserController::class,'users']);


//Mesa de Partes
Route::post('/mesapartes/store/', [MesapartesController::class,'store']);

//TipoPersonas
Route::get('/mesapartes/tipopersonas/', [TipoPersonasController::class,'show']);

//TipoDocumentoIdentidad
Route::get('/mesapartes/tipodocumentoidentidad/', [TipoDocumentosidentidadesController::class,'show']);
Route::get('/mesapartes/tipodocumento/', [TipoDocumentosController::class,'show']);
