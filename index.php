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
//->setClient() //ser� opcional caso nao seja selecionado ser� utilizado um tipo de client padr�o ainda a ser definido
//->basicAuth('2', '166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140') // ser� opcional por padr�o n�o ser� utilizado authenticacao
//->setHeader(['ixcsoft' => 'listar', 'Authorization' => 'Basic ' . $credencials]) // ser� opcional com os headers padr�es do client utilizado
//->setHeader(['ixcsoft' => 'listar']) // ser� opcional com os headers padr�es do client utilizado
//->setUri('https://192.168.33.146/webservice/v1') //ser� obrigat�rio para sabermos a url da API que esta sendo consumida
//->get('/cliente'); // ser� obrigat�rio o m�todo a ser utilizado get, post, put ou delete

#Exemplo sem setar client e autentica��o com m�todos padr�es
//$credencials = base64_encode('2:166d2c1afbd81248dacb6ade049e871d6138676081a0926694a32d5024291140');
//$return = (new RequestRunner())
//    ->setHeader(['ixcsoft' => 'listar', 'Authorization' => 'Basic ' . $credencials])
//    ->setUri('https://192.168.33.146/webservice/v1')
//    ->get('/cliente');
//
//echo json_encode($return);

#Exemplo sem setar client e utilizando basic auth com m�todos padr�es
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

