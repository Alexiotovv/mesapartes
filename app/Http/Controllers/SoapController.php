<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

use nusoap_client;


class SoapController extends Controller
{
    //env developming
    // http://161.132.150.56/wsentidad/Entidad?wsdl
    // http://161.132.150.56/wsiopidetramite/IOTramite?wsdl

    
    public function api_RecepcionarTramiteResponse(Request $request){
        // Configurar el servicio SOAP
        //$url='https://ws3.pide.gob.pe/services/PcmCuo?wsdl';
        
        $url='https://ws3.pide.gob.pe/services/PcmIMgdTramite?wsdl';
        //$url='http://161.132.150.56/wsiopidetramite/IOTramite?wsdl';
        $client = new nusoap_client($url, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;
        $params = [
            //'ip' => '45.5.58.101',

            // // 'vrucentrem'=>request('vrucentrem'),
            // // 'Vrucentrec'=>request('Vrucentrec'),
            // // 'vnomentemi'=>request('vnomentemi'),
            // // 'Vuniorgrem'=>request('Vuniorgrem'),
            // // 'vcuo'=>request('vcuo'),
            // // 'vcuoref'=>request('vcuoref'),//NO OBLIGATORIO
            // // 'ccodtipdoc'=>request('ccodtipdoc'),
            // // 'vnumdoc'=>request('vnumdoc'),
            // // 'dfecdoc'=>request('dfecdoc'),
            // // 'vuniorgdst'=>request('vuniorgdst'),
            // // 'vnomdst'=>request('vnomdst'),
            // // 'vnomcardst'=>request('vnomcardst'),
            // // 'vasu'=>request('vasu'),
            // // 'snumanx'=>request('snumanx'),
            // // 'snumfol'=>request('snumfol'),
            // // 'bpdfdoc'=>request('bpdfdoc'),
            // // 'vnomdoc'=>request('vnomdoc'),
            // // 'lstanexos-vnomdoc'=>request('lstanexos-vnomdoc'),//NO OBLIGATORIO
            // // 'vurldocanx'=>request('vurldocanx'),//NO OBLIGATORIO
            // // 'ctipdociderem'=>request('ctipdociderem'),
            // // 'vnumdociderem'=>request('vnumdociderem'),
            

            //TABLA PIDE
            'vrucentrem'=>'20493196902', //RUC de la Entidad remitente de los datos (esto puede cambiar)
            'Vrucentrec'=>'20493196902', //RUC de la Entidad recepciona los datos(siempre será GOREL)
            'vnomentemi'=>'GRL', //Nombre de la Entidad que emite los datos
            'Vuniorgrem'=>'MPV', //Unidad orgánica que remite el documento
            'vcuo'=>'4010337392', //Código único de operación======(API)
            'vcuoref'=>'', //Código único de operación de referencia NO OBLIGATORIO
            'ccodtipdoc'=>'02', //Tipo de documento 01=OFICIO,02=CARTA =======(API)
            'vnumdoc'=>'1532024', //**Número de documento
            'dfecdoc'=>'2027-02-01T08:44:55.857-05:00', //Fecha del documento
            
            'vuniorgdst'=>'OTI', // **Nombre de la unidad orgánica de destino-OFICINA
            'vnomdst'=>'JUAN', //Nombre del destinatario
            'vnomcardst'=>'PEREZ', //Nombre del cargo del destinatario
            'vasu'=>'ASUNTO DOC PRUEBA',//Asunto
            'snumanx'=>'2',//Número de Anexos [0 o Mayor a 0]
            'snumfol'=>'10',//Número de folios
            'bpdfdoc'=>'1',//Documento Principal
            'vnomdoc'=>'XXXA786', //Nombre del Documento
            'lstanexos-vnomdoc'=>'',//Listado de Anexos [Solo si snumanx Mayor a 0] Nombre del documentoNO OBLIGATORIO
            'vurldocanx'=>'https://mesadepartes.regionloreto.gob.pe/documentos/mpv/doc0001.pdf',//NO OBLIGATORIO
            'ctipdociderem'=>'1',//1=DNI, 2=CARNET DE EXTRANJERIA
            'vnumdociderem'=>'45690475',//N° DOC IDENTIDAD

        ];
        // Hacer la solicitud SOAP
        $response = $client->call('recepcionarTramiteResponse',$params);
        return response()->json($response);

    }


    public function api_ValidarEntidad($ruc_entidad){
        $url = 'https://ws3.pide.gob.pe/Rest/Pcm/ValidarEntidad?vrucent='.$ruc_entidad.'&out=json';
        $response = Http::get($url);
        $data = $response->json();
        $resultado = $data['validarEntidadResponse']['return'];
        return response()->json($resultado);
    }

    public function api_TipoDocumento(Request $request){
        $url='https://ws3.pide.gob.pe/services/PcmIMgdTramite?wsdl';
        //$url='http://161.132.150.56/wsiopidetramite/IOTramite?wsdl';
        // Crear instancia de NuSOAP client
       $client = new nusoap_client($url, true);

       // Llamada a la operación getTipoDocumento
       $response = $client->call('getTipoDocumento');

       // Verificar si hay errores en la llamada
       $error = $client->getError();
       if ($error) {
        return response()->json("Error en la llamada SOAP: " . $error);
       }

        // Manejar la respuesta según sea necesario
        return response()->json($response['return']);

    }

    public function api_CodigoUnicoOperacion(Request $request)
    {
        try {
            // Configurar el servicio SOAP
            
            $url='https://ws3.pide.gob.pe/services/PcmCuo?wsdl';
            $client = new nusoap_client($url, 'wsdl');
            $client->soap_defencoding = 'UTF-8';
            $client->decode_utf8 = false;
            $params = [
                'ip' => '45.5.58.101',
                'ruc'=>'20493196902',//siempre será gorel quien solicite CUO
                'servicio'=>'3011'//el servicio siempre será 3011 = Envío de Documentos
            ];
            // Hacer la solicitud SOAP
            $response = $client->call('getCUO', $params);//En produccion es getCUOEntidad

            if ($client->fault) {
                return response()->json([
                    'error' => 'Error en la llamada al servicio',
                    'details' => $client->getError()
                ]);
            } else {
                // Verificar si hay errores en la respuesta
                if ($client->getError()) {
                    return response()->json([ 
                        'error' => 'Error en la respuesta del servicio', 
                        'details' => $client->getError()]);
                } else {
                    $response=['cuo'=>$response['return']];
                    return response()->json($response);
                }
            }

            //$url='https://ws3.pide.gob.pe/Rest/Pcm/ListaEntidad?sidcatent=1';

            // Verificar si hay errores en la solicitud

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error desconocido: ' . $e->getMessage()]);
        }

    }
}
