<?php

ini_set('error_reporting', 1);
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('America/Sao_Paulo');
require_once './src/vendor/autoload.php';

$nfe = new NFEPHP2\NFeFacade();

try
{
    //var_dump($nfe->inutilizarNumeracao('14', '3', '5', '5', "teste de Inutilizacao"));
}
catch(Exception $e)
{
    echo ($e->getMessage());
}
exit;