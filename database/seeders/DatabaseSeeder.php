<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //01 oficio 02 carta
        //

        DB::table('tipo_documentosidentidades')->insert([
            ['codigo' => '01', 'nombre_tipodocumentoidentidad' => 'DNI'],
            ['codigo' => '02', 'nombre_tipodocumentoidentidad' => 'CE']]
        );

        DB::table('tipo_personas')->insert([
            ['codigo' => '01', 'nombre_tipopersonas' => 'JURIDICA'],
            ['codigo' => '02', 'nombre_tipopersonas' => 'NATURAL']]
        );

        DB::table('tipo_documentos')->insert([
            ['codigo' => '001', 'nombre_tipodocumentos' => 'OFICIO'],
            ['codigo' => '002', 'nombre_tipodocumentos' => 'CARTA'],
            ['codigo' => '004', 'nombre_tipodocumentos'=> 'AYUDA MEMORIA'],
            ['codigo' => '233', 'nombre_tipodocumentos'=> 'CARTA'],
            ['codigo' => '005', 'nombre_tipodocumentos'=> 'DIRECTIVA'],
            ['codigo' => '015', 'nombre_tipodocumentos'=> 'EXPOSICIÓN DE MOTIVOS'],
            ['codigo' => '009', 'nombre_tipodocumentos'=> 'INFORME'],
            ['codigo' => '010', 'nombre_tipodocumentos'=> 'MEMORANDO'],
            ['codigo' => '234', 'nombre_tipodocumentos'=> 'MEMORANDO MULTIPLE'],
            ['codigo' => '013', 'nombre_tipodocumentos'=> 'NOTA DE ELEVACIÓN'],
            ['codigo' => '011', 'nombre_tipodocumentos'=> 'OFICIO'],
            ['codigo' => '250', 'nombre_tipodocumentos'=> 'OFICIO CIRCULAR'],
            ['codigo' => '012', 'nombre_tipodocumentos'=> 'OFICIO MULTIPLE'],
            ['codigo' => '238', 'nombre_tipodocumentos'=> 'OTROS'],
            ['codigo' => '232', 'nombre_tipodocumentos'=> 'PROVEIDO'],
            ['codigo' => '006', 'nombre_tipodocumentos'=> 'RESOLUCIÓN'],
            ['codigo' => '008', 'nombre_tipodocumentos'=> 'RESOLUCIÓN JEFATURAL'],
            ['codigo' => '016', 'nombre_tipodocumentos'=> 'RESOLUCIÓN VICEMINISTERIAL'],
            ['codigo' => '014', 'nombre_tipodocumentos'=> 'RESUMEN EJECUTIVO'],
            ['codigo' => '237', 'nombre_tipodocumentos'=> 'SOBRE CERRADO'],
            ['codigo' => '235', 'nombre_tipodocumentos'=> 'SOLICITUD']
            ]
            
        );
    }
}
