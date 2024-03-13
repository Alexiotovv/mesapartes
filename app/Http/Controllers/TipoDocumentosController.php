<?php

namespace App\Http\Controllers;

use App\Models\tipo_documentos;
use Illuminate\Http\Request;
use DB;
class TipoDocumentosController extends Controller
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
       
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_documentos $tipo_documentos)
    {
        try {
            $tipodoc = DB::table('tipo_documentos')
            ->select('tipo_documentos.id',
            'tipo_documentos.codigo',
            'tipo_documentos.nombre_tipodocumentos')
            ->get();
            
            return response()->json(['data'=>$tipodoc], 200);
            
        } catch (\Throwable $th) {
            return response()->json(['data'=>$th], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_documentos $tipo_documentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_documentos $tipo_documentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_documentos $tipo_documentos)
    {
        //
    }
}
