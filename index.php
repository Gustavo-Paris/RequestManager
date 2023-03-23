<?php

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


#Exemplo de request
try {
    $response = (new \RequestManager\examples\GuzzleExample03())->exampleRequest(
        (new \RequestManager\Requests\GuzzleRequest()),$uri, $router, $username, $password, $header);

    echo $response;

} catch (Exception $e) {
    echo json_encode([
        'Code: ' . $e->getCode(),
        'Message: ' . str_replace('\\', '', $e->getMessage())
        ]);
}
