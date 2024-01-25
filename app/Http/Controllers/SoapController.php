<?php

namespace App\Http\Controllers;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

use Illuminate\Http\Request;

class SoapController extends Controller
{
    public function consumeSoap()
    {
        // Configurar el servicio SOAP
        SoapWrapper::add(function ($service) {
            $service
                ->name('pide') // Puedes darle el nombre que desees
                ->wsdl('https://ws3.pide.gob.pe/services/PcmIMgdEntidad.PcmIMgdEntidadHttpsSoap11Endpoint')
                ->trace(true); // Puedes habilitar el rastreo para depuración
        });

        // Hacer la solicitud SOAP
        $response = SoapWrapper::call('pide.YourOperation', [
            // Parámetros de la operación si es necesario
        ]);

        // Manejar la respuesta como desees
        dd($response);
    }
}