<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Probando APis</title>

</head>
<body>
    
<div class="row">
    <div class="col-sm-6">
        <a href="{{route('test')}}" class="btn btn-primary" id="btnEnviar">
            Enviar
        </a>
    </div>
</div>

<script>
    // $("#btnEnviar").on("click",function (e) { 
    //     e.preventDefault();
        
    //     // Datos de la solicitud
    //     // var soapRequest = `<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.wsiopidetramite.segdi.gob.pe/">
    //     //                        <soapenv:Header/>
    //     //                        <soapenv:Body>
    //     //                           <ws:cargoResponse>
    //     //                              <request>
    //     //                                 <vrucentemi>20168999926</vrucentemi>
    //     //                                 <vrucentrec>11111111111</vrucentrec>
    //     //                                 <vcuo>0000000020</vcuo>
    //     //                                 <vcuoref></vcuoref>
    //     //                                 <vnumregstd>1234</vnumregstd>
    //     //                                 <vanioregstd>2017</vanioregstd>
    //     //                                 <dfecregstd>2017-12-27T15:21:48.857-05:00</dfecregstd>
    //     //                                 <vuniorgstd>OTI</vuniorgstd>
    //     //                                 <vusuregstd>ARTURO</vusuregstd>
    //     //                                 <bcarstd>-1</bcarstd>
    //     //                                 <vobs></vobs>
    //     //                                 <cflgest>P</cflgest>
    //     //                              </request>
    //     //                           </ws:cargoResponse>
    //     //                        </soapenv:Body>
    //     //                     </soapenv:Envelope>`;
    
        
    //     // Configuración de la solicitud AJAX
    //     $.ajax({
    //         url: 'https://ws3.pide.gob.pe/services/PcmIMgdEntidad.PcmIMgdEntidadHttpsSoap11Endpoint',
    //         type: 'GET',
    //         contentType: 'text/xml',
    //         crossDomain: true,
    //         success: function (data, status, jqXHR) {
    //             alert("Está bien")
    //             console.log(data);
    //             console.log(status);
    //         },
    //         error: function (jqXHR, status, error) {
    //             alert("Con error")
    //             console.error(error);
    //             console.log(status);
    //         }
    //     });


    // });


</script>

</body>
</html>