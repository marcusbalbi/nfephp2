<?php

ini_set('error_reporting', 1);
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('America/Sao_Paulo');
require './src/vendor/autoload.php';


use NFEPHP2\NFe\XML\Exceptions\NfeAssinarException;
use NFEPHP2\NFe\XML\Exceptions\NfeValidarException;
use NFEPHP2\NFe\XML\Exceptions\NfeGeradorException;
use NFEPHP2\NFe\XML\Exceptions\NfeEnviarException;
use NFEPHP2\NFe\XML\Exceptions\NfeConsultarException;

$nfe = new NFEPHP2\NFeFacade();
 $aEnd = array('razao' => 'HOTEL COPACABANA', 'logradouro' => 'AV. ATLANTICA', 'numero' => '1702', 'complemento' => '', 'bairro' => 'COPACABANA', 'CEP' => '22021001', 'municipio' => 'RIO DE JANEIRO', 'UF' => 'RJ', 'telefone' => '2100000000', 'email' => 'copa@copapalace.com.br');
$nfe->imprimirCCe("nfe/homologacao/cartacorrecao/33140412760349000100550030000000141513204127-1-procCCe.xml",$aEnd);