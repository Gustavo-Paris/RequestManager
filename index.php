<?php

require "vendor/autoload.php";

use RequestManager\RequestRunner;

//$postData = [
//    'qtype' => 'cliente.id',
//    'query' => '10',
//    'oper' => '=',
//    'page' => '1',
//    'rp' => '20',
//    'sortname' => 'cliente.id',
//    'sortorder' => 'asc'
//];

//new RequestRunner()
//->setClient() //será opcional caso nao seja selecionado será utilizado um tipo de client padrão ainda a ser definido
//->basicAuth('2', '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140') // será opcional por padrão não será utilizado authenticacao
//->setHeader(['ixcsoft' => 'listar', 'Authorization' => 'Basic ' . $credencials]) // será opcional com os headers padrões do client utilizado
//->setHeader(['ixcsoft' => 'listar']) // será opcional com os headers padrões do client utilizado
//->setUri('https://192.168.33.146/webservice/v1') //será obrigatório para sabermos a url da API que esta sendo consumida
//->get('/cliente'); // será obrigatório o método a ser utilizado get, post, put ou delete

#Exemplo sem setar client e autenticação com métodos padrões
//$credencials = base64_encode('2:166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140');
//$return = (new RequestRunner())
//    ->setHeader(['ixcsoft' => 'listar', 'Authorization' => 'Basic ' . $credencials])
//    ->setUri('https://192.168.33.146/webservice/v1')
//    ->get('/cliente');
//
//echo json_encode($return);

#Exemplo sem setar client e utilizando basic auth com métodos padrões
//$credencials = base64_encode('2:166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140');
//$return = (new RequestRunner())
//    ->basicAuth('2', '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140')
//    ->setHeader(['ixcsoft' => 'listar'])
//    ->setUri('https://192.168.33.146/webservice/v1')
//    ->get('/cliente');

$return = (new RequestRunner())
    ->basicAuth('2', '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140')
    ->setHeader(['ixcsoft' => 'listar'])
    ->setUri('https://192.168.33.146/webservice/v1')
    ->get('/cliente');

echo json_encode($return);

