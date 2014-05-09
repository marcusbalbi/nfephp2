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

$nfe->danfeNFeImprimir("nfe/homologacao/consultadas/NFe33140412760349000100550030000000031513204123.xml");