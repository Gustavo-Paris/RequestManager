<?php

use RequestManager\Requests\PhpCurlClassRequest;

require "vendor/autoload.php";

$uri = 'https://192.168.33.146/webservice/v1';
$username = '2';
$password = '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140';
$router = 'cliente';
$header = ['ixcsoft' => 'listar'];

//$example1 = (new \RequestManager\examples\GuzzleExample01())->exampleRequest($uri, $router, $username, $password, $header);
//$example2 = (new \RequestManager\examples\GuzzleExample02())->exampleRequest(
//    $uri,
//    $router,
//    ['ixcsoft' => 'listar', 'Authorization' => 'Basic ' . base64_encode($username.':'.$password)]
//);


#Exemplo de request Guzzle
//try {
//    $response = (new \RequestManager\examples\GuzzleExample03())->exampleRequest(
//        (new \RequestManager\Requests\GuzzleRequest()),$uri, $router, $username, $password, $header);
//
//    echo $response;
//
//} catch (Exception $e) {
//    echo json_encode([
//        'Code: ' . $e->getCode(),
//        'Message: ' . str_replace('\\', '', $e->getMessage())
//        ]);
//}

//#Exemplo de request Curl
//try {
//    $reponse = new \RequestManager\RequestRunner();
//    $reponse->setClient((new \RequestManager\Requests\PhpCurlClassRequest()))
//        ->basicAuth($username, $password)
//        ->setHeader($header)
//        ->setUri($uri)
//        ->post('/cliente');
//
//} catch (Exception $e) {
//    echo json_encode([
//        'code: ' => $e->getCode(),
//        'message: ' => str_replace('\\', '', $e->getMessage())
//    ]);
//}

//#Exemplo de request Curl 01
try {
    $response = new \RequestManager\examples\PhpCurlClassRequestExample01();
    $response->exampleRequest(
        (new PhpCurlClassRequest()),
        $uri,
        $router,
        $username,
        $password,
        $header
    );

} catch (Exception $e) {
    echo json_encode([
        'code: ' => $e->getCode(),
        'message: ' => str_replace('\\', '', $e->getMessage())
    ]);
}