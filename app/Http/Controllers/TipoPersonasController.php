<?php

namespace App\Http\Controllers;

use App\Models\tipo_personas;
use Illuminate\Http\Request;
use DB;
class TipoPersonasController extends Controller
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
    public function show(tipo_personas $tipo_personas)
    {
        try {
            $personas = DB::table('tipo_personas')
            ->select('tipo_personas.id','tipo_personas.codigo','tipo_personas.nombre_tipopersonas')
            ->get();
            return response()->json(['data'=>$personas], 200);
            
        } catch (\Throwable $th) {
            return response()->json(['data'=>$th], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_personas $tipo_personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_personas $tipo_personas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_personas $tipo_personas)
    {
        //
    }
}
