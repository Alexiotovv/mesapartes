<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//use Phpforce\SoapClient\Soap\SoapClient;
// Make sure the namespace matches the one used in the library
//use Phpforce\SoapClient\SoapClient;
use nusoap_client;




class SoapController extends Controller
{
    public function consumeSoap(Request $request)
    {
        
        // try {

            // Configurar el servicio SOAP
            $client = new nusoap_client('https://ws3.pide.gob.pe/services/PcmIMgdEntidad.PcmIMgdEntidadHttpsSoap11Endpoint', 'wsdl');
            
            // 

            //$client = new nusoap_client('http://200.48.76.125/wsentidad/Entidad?wsdl', 'wsdl');
            $client->soap_defencoding = 'UTF-8';
            $client->decode_utf8 = false;

            // Parámetros para la llamada al servicio
            $params = ['getListaEntidad' => '1'];
            
            // Hacer la solicitud SOAP
            
            $response = $client->call('validarEntidad', $params);

            // Manejar la respuesta como desees
            return response()->json($response);

        // } catch (\Throwable $e) {
        //     return response()->json(['error' => 'Error desconocido: ' . $e->getMessage()]);

        // }

    }
}
