<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use nusoap_client;


class SoapController extends Controller
{
    //env developming
    // http://161.132.150.56/wsentidad/Entidad?wsdl
    // http://161.132.150.56/wsiopidetramite/IOTramite?wsdl

    
    public function api_RecepcionarTramiteResponse(Request $request){
        // Configurar el servicio SOAP
        //$url='https://ws3.pide.gob.pe/services/PcmCuo?wsdl';
        
        //$url='https://ws3.pide.gob.pe/services/PcmIMgdTramite?wsdl';
        $url='http://161.132.150.56/wsiopidetramite/IOTramite?wsdl';
        $client = new nusoap_client($url, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;
        $params = [
            'ip' => '45.5.58.101',
            'servicio'=>'3011',//el servicio siempre será 3011 = Envío de Documentos
            // 'vrucentrem'=>request('vrucentrem'),
            // 'Vrucentrec'=>request('Vrucentrec'),
            // 'vnomentemi'=>request('vnomentemi'),
            // 'Vuniorgrem'=>request('Vuniorgrem'),
            // 'vcuo'=>request('vcuo'),
            // 'vcuoref'=>request('vcuoref'),//NO OBLIGATORIO
            // 'ccodtipdoc'=>request('ccodtipdoc'),
            // 'vnumdoc'=>request('vnumdoc'),
            // 'dfecdoc'=>request('dfecdoc'),
            // 'vuniorgdst'=>request('vuniorgdst'),
            // 'vnomdst'=>request('vnomdst'),
            // 'vnomcardst'=>request('vnomcardst'),
            // 'vasu'=>request('vasu'),
            // 'snumanx'=>request('snumanx'),
            // 'snumfol'=>request('snumfol'),
            // 'bpdfdoc'=>request('bpdfdoc'),
            // 'vnomdoc'=>request('vnomdoc'),
            // 'lstanexos-vnomdoc'=>request('lstanexos-vnomdoc'),//NO OBLIGATORIO
            // 'vurldocanx'=>request('vurldocanx'),//NO OBLIGATORIO
            // 'ctipdociderem'=>request('ctipdociderem'),
            // 'vnumdociderem'=>request('vnumdociderem'),
            
            'vrucentrem'=>'20493196902', //Ruc quien emite Será siempre Gorel
            'Vrucentrec'=>'20131378972', //Ruc quien recibe
            'vnomentemi'=>'GRL', //Nombre Entidad quien Emite
            'Vuniorgrem'=>'MPV', //Nombre Unidad Orgánica quien Emite
            'vcuo'=>'0000003633',//Código Único de Operación===========(API)
            'vcuoref'=>'',//NO OBLIGATORIO
            'ccodtipdoc'=>'01',//01=OFICIO,02=CARTA ============(API)
            'vnumdoc'=>'1532024',
            'dfecdoc'=>'2027-02-01T08:44:55.857-05:00',
            'vuniorgdst'=>'OTI',
            'vnomdst'=>'JUAN',
            'vnomcardst'=>'PEREZ',
            'vasu'=>'ASUNTO DOC PRUEBA',
            'snumanx'=>'2',//Mayor igual a 0 (cero)
            'snumfol'=>'10',
            'bpdfdoc'=>'1',//Documento Principal
            'vnomdoc'=>'XXXA786', //Nombre del Documento
            'lstanexos-vnomdoc'=>'',//NO OBLIGATORIO
            'vurldocanx'=>'https://mesadepartes.regionsloreto.gob.pe/documentos/mpv/doc0001.pdf',//NO OBLIGATORIO
            'ctipdociderem'=>'1',//1=DNI, 2=CARNET DE EXTRANJERIA
            'vnumdociderem'=>'42565568',//N° Doc Identidad

        ];
        // Hacer la solicitud SOAP
        $response = $client->call('recepcionarTramiteResponse', $params);
        return response()->json($response);
    }

    public function api_TipoDocumento(Request $request){
        // $url='https://ws3.pide.gob.pe/Rest/Pcm/TipoDocumento?out=json';
        // $response = file_get_contents($url);

        //testing
        $url='http://161.132.150.56/wsiopidetramite/IOTramite?wsdl';
        //$url='https://ws3.pide.gob.pe/services/PcmIMgdTramite?wsdl';
        $client = new nusoap_client($url, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;
        $params = [
            // 'ip' => '45.5.58.105',
        ];
        $response = $client->call('getTipoDocumento', $params);
        return response()->json($response);

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
