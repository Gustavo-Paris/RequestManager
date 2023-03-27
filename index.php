<?php

use RequestManager\RequestRunner;
use RequestManager\Requests\GuzzleRequest;
use RequestManager\Requests\PhpCurlClassRequest;

require "vendor/autoload.php";

$uri = 'https://192.168.33.146/webservice/v1';
$username = '2';
$password = '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140';
$router = 'unidades';

echo '<h1>Request-Manager</h1>';
echo '<hr>';
//Example Multipart
//$data = [
//    [
//        'name' => 'descricao',
//        'contents' => 'Unidade API'
//    ],
//    [
//        'name' => 'sigla',
//        'contents' => 'UNAPI'
//    ]
//];

#################################
#    TESTE UTILIZANDO GUZZLE    #
#################################

//LIST UNITS IN API IXC
try {
    $url = sprintf('%s%s',
      '/',$router
    );
    $response = (new RequestRunner())
        ->setClient(new GuzzleRequest())
        ->basicAuth($username, $password)
        ->setHeader(['ixcsoft' => 'listar'])
        ->setUri($uri)
        ->get($url);

        echo json_encode($response);

} catch (Exception $e) {
    echo json_encode([
        'code: ' => $e->getCode(),
        'message: ' => str_replace('\\', '', $e->getMessage())
    ]);
}

//CREATE UNITS IN API IXC
// $data = [
//    [
//        'descricao' => 'descricao',
//        'sigla' => 'sigla'
//    ]
// ];
//try {
//    $url = sprintf('%s%s',
//        '/', $router
//    );
//    $response = (new RequestRunner())
//        ->setClient(new GuzzleRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->setData(['multipart' => $data])
//        ->post($url);
//
//    echo json_encode($response);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

//EDIT UNITS IN API IXC

//$data = [
//    'descricao' => 'Nova descricao',
//    'sigla' => 'NA'
//];
//try {
//    $url = sprintf('%s%s%s%s',
//    '/',
//        $router,
//        DIRECTORY_SEPARATOR,
//        30
//    );
//    $response = (new RequestRunner())
//        ->setClient(new GuzzleRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->setData(['json' => $data])
//        ->put($url);
//
//    echo json_encode($response);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

#DELETE UNITS IN API IXC
//try {
//    $url = sprintf('%s%s%s%s',
//    '/',
//        $router,
//        DIRECTORY_SEPARATOR,
//        30
//    );
//
//    $response = (new RequestRunner())
//        ->setClient(new GuzzleRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->delete($url);
//
//    echo json_encode($response);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => $e->getMessage()
//    ]);
//}


#################################
#TESTE UTILIZANDO PhpCurlRequest#
#################################

//LIST CLIENT IN API IXC
//try {
//    $url = sprintf('%s%s',
//      '/',$router
//    );
//    $response = (new RequestRunner())
//        ->setClient(new PhpCurlClassRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => 'listar'])
//        ->setUri($uri)
//        ->post($url);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

//CREATE CLIENT IN API IXC
//try {
//    $data = [
//        'descricao' => 'Nova descricao',
//        'sigla' => 'NA'
//    ];
//
//    $url = sprintf('%s%s',
//      '/',$router
//    );
//    $response = (new RequestRunner())
//        ->setClient(new PhpCurlClassRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->setData($data)
//        ->post($url);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

//EDIT CLIENT IN API IXC
//try {
//    $data =[
//        'descricao' => 'Nova descricao2',
//        'sigla' => 'NA2'
//    ];
//
//    $url = sprintf('%s%s%s%s',
//    '/',
//        $router,
//        DIRECTORY_SEPARATOR,
//        9
//    );
//    $response = (new RequestRunner())
//        ->setClient(new PhpCurlClassRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->setData($data)
//        ->put($url);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

//DELETE CLIENT IN API IXC
//try {
//
//    $url = sprintf('%s%s%s%s',
//    '/',
//        $router,
//        DIRECTORY_SEPARATOR,
//        24
//    );
//
//    $response = (new RequestRunner())
//        ->setClient(new PhpCurlClassRequest())
//        ->basicAuth($username, $password)
//        ->setHeader(['ixcsoft' => ''])
//        ->setUri($uri)
//        ->delete($url);
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}
