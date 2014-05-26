<?php 


ini_set('error_reporting', 1);
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('America/Sao_Paulo');
require 'src/vendor/autoload.php';

use NFEPHP2\NFe\XML\Exceptions\NfeAssinarException;
use NFEPHP2\NFe\XML\Exceptions\NfeValidarException;
use NFEPHP2\NFe\XML\Exceptions\NfeGeradorException;
use NFEPHP2\NFe\XML\Exceptions\NfeEnviarException;
use NFEPHP2\NFe\XML\Exceptions\NfeConsultarException;

$config = \Symfony\Component\Yaml\Yaml::parse("config/config.yml");

$config = array_shift($config);

$nfe = new NFEPHP2\NFeFacade($config);

$nfe->danfeNFeImprimir("33140512760349000100550010000002261937948681",array("textoRodape"=>"Exemplo de texto par rodape da NFE",
    "paginaWebRodape"=>"www.seusite.com.br"));