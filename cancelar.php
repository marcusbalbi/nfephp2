<?php

ini_set('error_reporting', 1);
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('America/Sao_Paulo');
require_once './src/vendor/autoload.php';

$nfe = new NFEPHP2\NFeFacade();

try
{

   $retorno =  $nfe->cancelarNFe("33140412760349000100550030000000131513204120", "333140000137970", "teste Cancelamento");
   
   var_dump($retorno);
   
}
catch(Exception $e)
{
    var_dump($e->getMessage());
}