<?php

namespace App\Http\Controllers;

use App\Models\mesapartes;
use App\Models\User;
use App\Models\userdetails;
use App\Models\documentos_anexos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class MesapartesController extends Controller
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

        // try {
            //Datos de usuario
            $email=request('email');
            
            //datos documento mesa de partes
            $atencion=request('atencion');
            $comentarios=request('comentarios');
            $tipo_documento=request('tipo_documento');
            $nro_documento=request('nro_documento');
            $nro_folios=request('nro_folios');
            $asunto=request('asunto');
            $documento=request('documento');
            
            $documento=request('documento_anexos');
            
            //Detalles de usuario
            //id_user ya se encuentra abajo;
            $tipo_persona=request('tipo_persona');
            $tipo_docidentidad=request('tipo_docidentidad');
            $dni_ce=request('dni_ce');
            $nombre=request('nombre');
            $ap_paterno=request('ap_paterno');
            $ap_materno=request('ap_materno');
            $ruc_entidad=request('ruc_entidad');
            $telefono=request('telefono');
            $direccion=request('direccion');

            $user = User::where('email', $email)->get();
            $id_usuario=0;

            // $user = User::where('email', $email)->get()[0]->id;
            
            if ($user->count()>0) { //Cuando el usuario existe actualiza userdetails
                // return response()->json(['data'=>'usuario existe'], 200);
                $id_usuario=$user[0]->id;
                $uds = userdetails::where('id_user',$id_usuario)->get()[0]->id;
                $ud = userdetails::findOrFail($uds);
                $ud->id_tipopersona=$tipo_persona;
                $ud->id_tipodocumentoidentidad=$tipo_docidentidad;
                $ud->dni_ce=$dni_ce;
                $ud->nombre=$nombre;
                $ud->ap_paterno=$ap_paterno;
                $ud->ap_materno=$ap_materno;
                $ud->ruc_entidad=$ruc_entidad;
                $ud->telefono=$telefono;
                $ud->direccion=$direccion;
                $ud->save();
            }else{
                //return response()->json(['data'=>$user], 200);
                //Cuando no existe el Usuario Registra Nuevo
                $nombre=explode(' ',$nombre);
                $nombre=$nombre[0];
                $usr = new User();
                $usr->name=$nombre;
                $usr->email=$email;
                $usr->password='#2024$1dcd32A21';
                $usr->save();
                $id_usuario=$usr->id;

                //Registra detalle del nuevo usuario
               
                $ud = new userdetails();
                $ud->id_user = $usr->id;
                $ud->id_tipopersona=$tipo_persona;
                $ud->id_tipodocumentoidentidad=$tipo_docidentidad;
                $ud->dni_ce=$dni_ce;
                $ud->nombre=$nombre;
                $ud->ap_paterno=$ap_paterno;
                $ud->ap_materno=$ap_materno;
                $ud->ruc_entidad=$ruc_entidad;
                $ud->telefono=$telefono;
                $ud->direccion=$direccion;
                $ud->save();

            }

            //Guarda Mesa de Partes
            $fechaHoraActual = Carbon::now();
            $mpv = new mesapartes();

            //Verificando el documento
            if ($request->hasFile('documento')){
                $file = request('documento')->getClientOriginalName();//archivo recibido
                $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                $extension = request('documento')->getClientOriginalExtension();//extensión
                $archivo= $filename.'_'.time().'.'.$extension;//
                request('documento')->storeAs('local/documentos/',$archivo,'local');//refiere carpeta publica es el nombre de disco
                $mpv->documento_principal = $archivo;

            }else{
                return response()->json(['data'=>'Documento Principal es requerido'], 500);
            }
            
            $mpv->id_user =  $id_usuario;
            $mpv->id_tipodocumentos = $tipo_documento;
            $mpv->numero_documento = $nro_documento;
            $mpv->asunto= $asunto;
            $mpv->comentarios=$comentarios;
            $mpv->atencion=$atencion;
            $mpv->comentarios=$comentarios;
            //$mpv->documento_principal=$documento;
            $mpv->nro_folios=$nro_folios;
            $mpv->fecha=$fechaHoraActual->format('Y-m-d');
            $mpv->hora=$fechaHoraActual->format('H:i:s');
            $mpv->save();

            //Verificando anexos
            if ($request->hasFile('documento_anexos')){
                $files=$request->file('documento_anexos');
                // return response()->json(['data'=>'si hay anexos'], 200);
                // dd($files);
                foreach ($files as $f) {
                    $file = $f->getClientOriginalName();//archivo recibido
                    $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                    $extension = $f->getClientOriginalExtension();//extensión
                    $archivo= $filename.'_'.time().'.'.$extension;//
                    
                    $f->storeAs('local/documentos_anexos/',$archivo,'local');//refiere carpeta publica es el nombre de Disco
                    
                    $ea= new documentos_anexos();
                    $ea->mesapartes_id = $mpv->id;
                    $ea->documento = $archivo;
                    $ea->save();
                }
            }

            // $users = DB::connection('external')->select('select * from users');
            
            // $resultados = DB::connection('sqlsrv')->select('EXEC get_correlativo ?',array(2024));


            return response()->json(['data'=>'heey'], 200);
            
            
        // } catch (\Throwable $th) {
        //     // if ($th=='') {
        //     //     $th='Error Server';
        //     // }
        //     return response()->json(['data'=>$th], 500);
        // }
        
        

    }


    /**
     * Display the specified resource.
     */
    public function show(mesapartes $mesapartes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mesapartes $mesapartes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mesapartes $mesapartes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mesapartes $mesapartes)
    {
        //
    }
}
