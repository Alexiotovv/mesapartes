<?php

namespace App\Http\Controllers;

use App\Models\tipo_documentosidentidades;
use Illuminate\Http\Request;
use DB;
class TipoDocumentosidentidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_documentosidentidades $tipo_documentosidentidades)
    {
        
        try {
            $tipodoc = DB::table('tipo_documentosidentidades')
            ->select('tipo_documentosidentidades.id',
            'tipo_documentosidentidades.codigo',
            'tipo_documentosidentidades.nombre_tipodocumentoidentidad')
            ->get();
            
            return response()->json(['data'=>$tipodoc], 200);
            
        } catch (\Throwable $th) {
            return response()->json(['data'=>$th], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_documentosidentidades $tipo_documentosidentidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_documentosidentidades $tipo_documentosidentidades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_documentosidentidades $tipo_documentosidentidades)
    {
        //
    }
}
