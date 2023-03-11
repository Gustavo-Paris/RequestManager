<?php

require "vendor/autoload.php";

use RequestManager\RequestRunner;


$header = [
    'Content-type' => 'application/x-www-form-urlencoded; charset=utf-8',
    'ixcsoft' => 'listar'
];
$uri = "https://devssl.ixcsoft.com.br/webservice/v1";

$postData = [
    'qtype' => 'cliente.id',
    'query' => '10',
    'oper' => '=',
    'page' => '1',
    'rp' => '20',
    'sortname' => 'cliente.id',
    'sortorder' => 'asc'
];

$return = (new RequestRunner())
    ->setClient(null)
    ->basicAuth('1', '7fd4093bea485f72fa6c1750128e5b0018990122a0e48393eca838d15ced8675')
    ->setHeader($header)
    ->setUri($uri)
    ->setData($postData)
    ->post('/cliente');

echo '<pre>';
print_r($return);exit;
