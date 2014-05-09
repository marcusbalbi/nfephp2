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

$gerador = new NFEPHP2\NFe\XML\Gerador\geradorNFe();

//DADOS IDE
$gerador->ide->NFref = array();
$gerador->ide->cUF = '33'; //codigo numerico do estado
$gerador->ide->cNF = '51320412'; //numero aleatório da NF
$gerador->ide->natOp = 'RETORNO DE INSUMOS UTILIZADOS'; //natureza da operação
$gerador->ide->indPag = '0'; ////0=Pagamento à vista; 1=Pagamento a prazo; 2=Outros
$gerador->ide->mod = '55'; //modelo da NFe 55 ou 65 essa última NFCe
$gerador->ide->serie = '3'; //serie da NFe
$gerador->ide->nNF = '19'; // numero da NFe
$gerador->ide->dEmi = '2014-04-08';  //para versão 3.00 '2014-02-03T13:22:42-3.00' não informar para NFCe
$gerador->ide->dSaiEnt = '2014-04-08'; //versão 2.00, 3.00 e 3.10
$gerador->ide->tpNF =  '1';
$gerador->ide->cMunFG = '3300506';
$gerador->ide->tpImp = '1';//0=Sem geração de DANFE; 1=DANFE normal, Retrato; 2=DANFE normal, Paisagem;
                        //3=DANFE Simplificado; 4=DANFE NFC-e; 5=DANFE NFC-e em mensagem eletrônica
                        //(o envio de mensagem eletrônica pode ser feita de forma simultânea com a impressão do DANFE;
                        //usar o tpImp=5 quando esta for a única forma de disponibilização do DANFE).
$gerador->ide->tpEmis  = '1'; //1=Emissão normal (não em contingência);
                        //2=Contingência FS-IA, com impressão do DANFE em formulário de segurança;
                        //3=Contingência SCAN (Sistema de Contingência do Ambiente Nacional);
                        //4=Contingência DPEC (Declaração Prévia da Emissão em Contingência);
                        //5=Contingência FS-DA, com impressão do DANFE em formulário de segurança;
                        //6=Contingência SVC-AN (SEFAZ Virtual de Contingência do AN);
                        //7=Contingência SVC-RS (SEFAZ Virtual de Contingência do RS);
                        //9=Contingência off-line da NFC-e (as demais opções de contingência são válidas também para a NFC-e);
                        //Nota: Para a NFC-e somente estão disponíveis e são válidas as opções de contingência 5 e 9.
$gerador->ide->tpAmb = '2'; //1=Produção; 2=Homologação
$gerador->ide->finNFe = '1'; //1=NF-e normal; 2=NF-e complementar; 3=NF-e de ajuste; 4=Devolução/Retorno.
$gerador->ide->indFinal = ''; //0=Não; 1=Consumidor final;
//$gerador->ide->ind = ''; //0=Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);
               //1=Operação presencial;
               //2=Operação não presencial, pela Internet;
               //3=Operação não presencial, Teleatendimento;
               //4=NFC-e em operação com entrega a domicílio;
               //9=Operação não presencial, outros.
$gerador->ide->procEmi = '0'; //0=Emissão de NF-e com aplicativo do contribuinte;
                //1=Emissão de NF-e avulsa pelo Fisco;
                //2=Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco;
                //3=Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco.
$gerador->ide->verProc = '2.0'; //versão do aplicativo emissor
//$gerador->ide->dhCont = ''; //entrada em contingência AAAA-MM-DDThh:mm:ssTZD
//$gerador->ide->xJust = ''; //Justificativa da entrada em contingência

//Dados do emitente
$gerador->emit->CNPJ = '12760349000100';
$gerador->emit->CPF = '';
$gerador->emit->xNome = 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL';
$gerador->emit->xFant = 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL';
$gerador->emit->IE =  '79215279';
$gerador->emit->IEST = '';
$gerador->emit->IM = '';
$gerador->emit->CNAE = '';
$gerador->emit->CRT = 3;

//endereço do emitente
$gerador->emit->enderEmit->xLgr = 'RUA DOS PATRIOTAS';
$gerador->emit->enderEmit->nro = '897';
$gerador->emit->enderEmit->xCpl = 'ARMAZEM 42';
$gerador->emit->enderEmit->xBairro = 'IPIRANGA';
$gerador->emit->enderEmit->cMun = '3300506';
$gerador->emit->enderEmit->xMun = 'Sao Paulo';
$gerador->emit->enderEmit->UF = 'RJ';
$gerador->emit->enderEmit->CEP = '28625530';
$gerador->emit->enderEmit->cPais = '1058';
$gerador->emit->enderEmit->xPais = 'BRASIL';
$gerador->emit->enderEmit->fone = '1120677300';
        
//destinatário
$gerador->dest->CNPJ = '35943604000580';
$gerador->dest->CPF = '';
$gerador->dest->xNome = 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL';
$gerador->dest->IE = '';
$gerador->dest->ISUF = '';
$gerador->dest->email = 'mrsptm@seuemail.com.br';

//Endereço do destinatário
$gerador->dest->enderDest->xLgr = 'RUA LUZITANIA';
$gerador->dest->enderDest->nro = '1163';
$gerador->dest->enderDest->xCpl = '';
$gerador->dest->enderDest->xBairro = 'CENTRO';
$gerador->dest->enderDest->cMun = '3300506';
$gerador->dest->enderDest->xMun = 'Campinas';
$gerador->dest->enderDest->UF = 'RJ';
$gerador->dest->enderDest->CEP = '13015121';
$gerador->dest->enderDest->cPais = '1058';
$gerador->dest->enderDest->xPais = 'BRASIL';
$gerador->dest->enderDest->fone = '1932740607';


//TAG DET/PROD
$gerador->det[0] = new \NFEPHP2\NFe\XML\Gerador\Produtos\det();
$gerador->det[0]->nItem = '1';

$gerador->det[0]->prod->cProd = "26.10.0708";
$gerador->det[0]->prod->cEAN = "";
$gerador->det[0]->prod->xProd = "MINI PLAQUINHA OSKLEN";
$gerador->det[0]->prod->NCM = "83100000";
$gerador->det[0]->prod->NVE = "";
$gerador->det[0]->prod->EXTIPI = "";
$gerador->det[0]->prod->CFOP = "5902";
$gerador->det[0]->prod->uCom = "UN";
$gerador->det[0]->prod->qCom = "80";
$gerador->det[0]->prod->vUnCom = "1.93";
$gerador->det[0]->prod->vProd = "154.40";
$gerador->det[0]->prod->cEANTrib = "";
$gerador->det[0]->prod->uTrib = "UN";
$gerador->det[0]->prod->qTrib = "80";
$gerador->det[0]->prod->vUnTrib = "1.93";
$gerador->det[0]->prod->vFrete = "";
$gerador->det[0]->prod->vSeg = "";
$gerador->det[0]->prod->vDesc = "";
$gerador->det[0]->prod->vOutro = "";
$gerador->det[0]->prod->indTot = "1";
$gerador->det[0]->prod->xPed = "";

//DET/IMPOSTO
$gerador->det[0]->imposto->vTotTrib = "0.00";

//DET/IMPOSTO/ICMS
$gerador->det[0]->imposto->ICMS->orig = "0";
$gerador->det[0]->imposto->ICMS->CST = "00";
$gerador->det[0]->imposto->ICMS->modBC = "3";
$gerador->det[0]->imposto->ICMS->vBC = "154.40";
$gerador->det[0]->imposto->ICMS->pICMS = "19.00";
$gerador->det[0]->imposto->ICMS->vICMS = "29.34";

//DET/IMPOSTO/PIS
$gerador->det[0]->imposto->PIS->CST = "01";
$gerador->det[0]->imposto->PIS->vBC = "154.40";
$gerador->det[0]->imposto->PIS->pPIS = "0.65";
$gerador->det[0]->imposto->PIS->vPIS = "1.00";
   
//DET/IMPOSTO/COFINS
$gerador->det[0]->imposto->COFINS->CST = "01";
$gerador->det[0]->imposto->COFINS->vBC = "120.00";
$gerador->det[0]->imposto->COFINS->pCOFINS = "3.00";
$gerador->det[0]->imposto->COFINS->vCOFINS = "4.63";   


//PROD 2
$gerador->det[1] = new \NFEPHP2\NFe\XML\Gerador\Produtos\det();
$gerador->det[1]->nItem = '2';

$gerador->det[1]->prod->cProd = "40.01.0006";
$gerador->det[1]->prod->cEAN = "";
$gerador->det[1]->prod->xProd = "ETIQ.P/CODIGO DE BARRA GRANDE  NOVA";
$gerador->det[1]->prod->NCM = "48211000";
$gerador->det[1]->prod->NVE = "";
$gerador->det[1]->prod->EXTIPI = "";
$gerador->det[1]->prod->CFOP = "5902";
$gerador->det[1]->prod->uCom = "UN";
$gerador->det[1]->prod->qCom = "80";
$gerador->det[1]->prod->vUnCom = "0.05";
$gerador->det[1]->prod->vProd = "4.00";
$gerador->det[1]->prod->cEANTrib = "";
$gerador->det[1]->prod->uTrib = "UN";
$gerador->det[1]->prod->qTrib = "80";
$gerador->det[1]->prod->vUnTrib = "0.05";
$gerador->det[1]->prod->vFrete = "";
$gerador->det[1]->prod->vSeg = "";
$gerador->det[1]->prod->vDesc = "";
$gerador->det[1]->prod->vOutro = "";
$gerador->det[1]->prod->indTot = "1";
$gerador->det[1]->prod->xPed = "";

//DET/IMPOSTO
$gerador->det[1]->imposto->vTotTrib = "0.00";

//DET/IMPOSTO/ICMS
$gerador->det[1]->imposto->ICMS->orig = "0";
$gerador->det[1]->imposto->ICMS->CST = "00";
$gerador->det[1]->imposto->ICMS->modBC = "3";
$gerador->det[1]->imposto->ICMS->vBC = "4.00";
$gerador->det[1]->imposto->ICMS->pICMS = "19.00";
$gerador->det[1]->imposto->ICMS->vICMS = "0.76";

//DET/IMPOSTO/PIS
$gerador->det[1]->imposto->PIS->CST = "01";
$gerador->det[1]->imposto->PIS->vBC = "4.00";
$gerador->det[1]->imposto->PIS->pPIS = "0.65";
$gerador->det[1]->imposto->PIS->vPIS = "0.03";
   
//DET/IMPOSTO/COFINS
$gerador->det[1]->imposto->COFINS->CST = "01";
$gerador->det[1]->imposto->COFINS->vBC = "4.00";
$gerador->det[1]->imposto->COFINS->pCOFINS = "3.00";
$gerador->det[1]->imposto->COFINS->vCOFINS = "0.12";   

//PROD 3
$gerador->det[2] = new \NFEPHP2\NFe\XML\Gerador\Produtos\det();
$gerador->det[2]->nItem = '3';

$gerador->det[2]->prod->cProd = "40.03.0043";
$gerador->det[2]->prod->cEAN = "";
$gerador->det[2]->prod->xProd = "TAG DUPLO COLLECTION";
$gerador->det[2]->prod->NCM = "48211000";
$gerador->det[2]->prod->NVE = "";
$gerador->det[2]->prod->EXTIPI = "";
$gerador->det[2]->prod->CFOP = "5902";
$gerador->det[2]->prod->uCom = "UN";
$gerador->det[2]->prod->qCom = "80";
$gerador->det[2]->prod->vUnCom = "0.48";
$gerador->det[2]->prod->vProd = "38.40";
$gerador->det[2]->prod->cEANTrib = "";
$gerador->det[2]->prod->uTrib = "UN";
$gerador->det[2]->prod->qTrib = "80";
$gerador->det[2]->prod->vUnTrib = "0.48";
$gerador->det[2]->prod->vFrete = "";
$gerador->det[2]->prod->vSeg = "";
$gerador->det[2]->prod->vDesc = "";
$gerador->det[2]->prod->vOutro = "";
$gerador->det[2]->prod->indTot = "1";
$gerador->det[2]->prod->xPed = "";

//DET/IMPOSTO
$gerador->det[2]->imposto->vTotTrib = "0.00";

//DET/IMPOSTO/ICMS
$gerador->det[2]->imposto->ICMS->orig = "0";
$gerador->det[2]->imposto->ICMS->CST = "00";
$gerador->det[2]->imposto->ICMS->modBC = "3";
$gerador->det[2]->imposto->ICMS->vBC = "38.40";
$gerador->det[2]->imposto->ICMS->pICMS = "19.00";
$gerador->det[2]->imposto->ICMS->vICMS = "7.30";

//DET/IMPOSTO/PIS
$gerador->det[2]->imposto->PIS->CST = "01";
$gerador->det[2]->imposto->PIS->vBC = "38.40";
$gerador->det[2]->imposto->PIS->pPIS = "0.65";
$gerador->det[2]->imposto->PIS->vPIS = "0.25";
   
//DET/IMPOSTO/COFINS
$gerador->det[2]->imposto->COFINS->CST = "01";
$gerador->det[2]->imposto->COFINS->vBC = "38.40";
$gerador->det[2]->imposto->COFINS->pCOFINS = "3.00";
$gerador->det[2]->imposto->COFINS->vCOFINS = "1.15";   
   
   //TOTAIS
$gerador->total->ICMSTot->vBC = "196.80";
$gerador->total->ICMSTot->vBCST = "0.00";
$gerador->total->ICMSTot->vCOFINS = "5.90";
$gerador->total->ICMSTot->vDesc = "0.00";
$gerador->total->ICMSTot->vFrete = "0.00";
$gerador->total->ICMSTot->vICMS = "37.39";
$gerador->total->ICMSTot->vII = "0.00";
$gerador->total->ICMSTot->vIPI = "0.00";
$gerador->total->ICMSTot->vNF = "196.80";
$gerador->total->ICMSTot->vOutro = "0.00";
$gerador->total->ICMSTot->vPIS = "1.28";
$gerador->total->ICMSTot->vProd = "196.80";
$gerador->total->ICMSTot->vST = "0.00";
$gerador->total->ICMSTot->vSeg = "0.00";




//transportadora
$gerador->transp->modFrete = '0'; //0=Por conta do emitente; 1=Por conta do destinatário/remetente; 2=Por conta de terceiros;
$gerador->transp->transporta->CNPJ = '34028316253150';
$gerador->transp->transporta->CPF = '';
$gerador->transp->transporta->xNome = 'EMPRESA BRASILEIRA DE CORREIOS E TELEGRAFOS';
$gerador->transp->transporta->IE = '81613524';
$gerador->transp->transporta->xEnder = 'AV GOV ROBERTO SILVEIRA';
$gerador->transp->transporta->xMun = 'Bom Jardim';
$gerador->transp->transporta->UF = 'RJ';



//dados dos veiculos de transporte
$gerador->transp->veicTransp->placa = 'AAA1212';
$gerador->transp->veicTransp->UF = 'RJ';
$gerador->transp->veicTransp->RNTC = '12345678';


//dados dos volumes transportados
$gerador->transp->vol[0] = new NFEPHP2\NFe\XML\Gerador\Transportadora\vol();
$gerador->transp->vol[0]->qVol = '1';
$gerador->transp->vol[0]->esp = 'CAIXA';
$gerador->transp->vol[0]->marca = '34567';
$gerador->transp->vol[0]->pesoL = '12.000';
$gerador->transp->vol[0]->pesoB = '12.000';

//dados dos volumes transportados
$gerador->transp->vol[1] = new NFEPHP2\NFe\XML\Gerador\Transportadora\vol();
$gerador->transp->vol[1]->qVol = '1';
$gerador->transp->vol[1]->esp = 'CAIXA';
$gerador->transp->vol[1]->marca = '12345';
$gerador->transp->vol[1]->pesoL = '12.000';
$gerador->transp->vol[1]->pesoB = '12.000';

//monta a NFe e retorna na tela
echo "<br>==========================VALIDACAO===========================<br>";
try
{
$resposta = $nfe->gerarNFe($gerador);
echo "GERADA!!";
}
catch(NfeGeradorException $e)
{
    var_dump($e->getMessage());exit;
}
echo "<br>==================================================================<br>";

echo "<br>==========================VALIDACAO===========================<br>";

try
{
    $nfe->validarNFe($resposta['chNFe'],'./src/schemes/PL_006s/nfe_v2.00.xsd');
    echo "VALIDADA!";
}
catch(NfeValidarException $e)
{
    var_dump($e->getMessage());exit;
}


echo "<br>==================================================================<br>";

echo "<br>=========================ASSINATURA===============================</br>";

try
{
   $nfe->assinarNFe($resposta['chNFe']);
}
catch(NfeAssinarException $e)
{
    var_dump($e->getMessage());exit;
    
}

echo "<br>==================================================================<br>";

echo "<br>==============================ENVIO================================<br>";
try
{
    $respostaEnvio = $nfe->enviarNFe($resposta['chNFe']);
    echo "NOTA ENVIADA RECIBO:".$respostaEnvio['nRec'];
    var_dump($respostaEnvio);
}
catch(NfeEnviarException $e)
{
    var_dump($e->getMessage());exit;
}
echo "<br>==================================================================<br>";

echo "<br>======================RECIBO======================================<br>";
sleep(3);

try{
   $respostaConsulta = $nfe->consultarNFe($respostaEnvio['nRec']);

   var_dump($respostaConsulta);
}
catch(NfeConsultarException $e)
{
     var_dump($e->getMessage());exit;
}

echo "<br>===================================================================<br>";

echo "<br>======================CARTA DE CORREÇÃO======================================<br>";
sleep(3);

try{
   $respostaCCe = $nfe->enviarCCeNfe($resposta['chNFe'],"CORRECAO de TESTE de NFE CARTA DE orrecao",1);

   var_dump($respostaCCe);
}
catch(NfeConsultarException $e)
{
     var_dump($e->getMessage());exit;
}

echo "<br>===================================================================<br>";