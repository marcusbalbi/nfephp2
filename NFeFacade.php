<?php

namespace NFEPHP2;

use ToolsNFePHP;
use NFe\XML\Gerador\geradorNFe;
use Symfony\Component\Yaml\Yaml;
use NFEPHP2\NFe\XML\Exceptions\NfeAssinarException;
use NFEPHP2\NFe\XML\Exceptions\NfeValidarException;
use NFEPHP2\NFe\XML\Exceptions\NfeEnviarException;
use NFEPHP2\NFe\XML\Exceptions\NfeConsultarException;
use NFEPHP2\NFe\XML\Exceptions\NfeInutilizarException;
use NFEPHP2\NFe\XML\Exceptions\NfeCancelarException;
use NFEPHP2\NFe\XML\Exceptions\NfeProcException;
use NFEPHP2\NFe\XML\Exceptions\NfeEnviarCCeException;
use DOMDocument;
/**
 * Description of NFe
 *
 * @author marcus
 */
class NFeFacade {
    
    /**
     * @var ToolsNFePHP
     */
    protected $toolsNFe;
    
    protected $dir;


    public function __construct($config = null) {
        
        if(empty($config))
        {
            $arrayConfig = Yaml::parse("config/config.yml");
            
            $config = array_shift($arrayConfig);

        }
         $this->dir =  realpath(dirname(__FILE__));
         $this->toolsNFe = new ToolsNFePHP ($config);
        
    }

    public function gerarNFe(NFe\XML\Gerador\geradorNFe $gerador)
    {
        try
        {
        $xml = $gerador->gerar();

            $path = $this->toolsNFe->entDir.$gerador->infNfe->Id . ".xml";
            
            $chNFe = substr($gerador->infNfe->Id,3);
            
            $resposta = array('chNFe'=>$chNFe,'path'=>$path);
            
            $this->salvarArquivo($path, $xml);
            
            return $resposta;
        }
        catch (NfeGeradorException $e)
        {
            throw $e;
        }
        
        
    }
    
    
    public function validarNFe($chNFe,$xsdFile = '')
    {
            $path = $this->toolsNFe->entDir."NFe{$chNFe}.xml";
            $xml = file_get_contents($path);
            $xsdFile = empty($xsdFile)? $this->dir.'/src/schemes/PL_006s/nfe_v2.00.xsd' : $xsdFile;

            $pathinfo = pathinfo($path);

            $aErro = array();
            if($this->toolsNFe->validXML($xml, $xsdFile,$aErro))
            {   
                $newPath = $this->toolsNFe->valDir.$pathinfo['basename'];

                $this->salvarArquivo($newPath, $xml);
                 //TODO  remover o arquivo antigo?


                $resposta = array('chNfFe'=>$chNFe,'path'=>$newPath);

                return $resposta;
            }
            else
            {
                $erro = "";

                foreach ($aErro as $er) {
                    $erro.=  $er.'<br>';
                }

                throw new NfeValidarException("Erro ao Validar a NFe :<br>".$erro);
            }
        
    }


    
    public function assinarNFe($chNFe)
    {
        $path = $this->toolsNFe->valDir."NFe{$chNFe}.xml";   
        $xml = file_get_contents($path);
        
        $pathinfo = pathinfo($path);

        if ($xml = $this->toolsNFe->signXML($xml, 'infNFe')) {

            $newPath = $this->toolsNFe->assDir.$pathinfo['basename'];
           
            $this->salvarArquivo($newPath, $xml);
            
           //TODO remover arquivo antigo?
            
            $reposta = array('chNFe'=>$chNFe,'path'=>$newPath);
            
            return $reposta;
            
        } else {
            throw new NfeAssinarException("Erro ao Assinar Arquivo");
        }
        
    }

    
    public function enviarNFe($chNFe)
    {
        
        //obter um numero de lote
        $lote = substr(str_replace(',', '', number_format(microtime(true) * 1000000, 0)), 0, 15);
        
        $path = $this->toolsNFe->assDir."NFe{$chNFe}.xml";
        $xml = file_get_contents($path);
        
        $pathinfo = pathinfo($path);
        
        // montar o array com a NFe
        $aNFe = array(0 => $xml);
        
            //enviar o lote
            if ($aResp = $this->toolsNFe->sendLot($aNFe, $lote)) {
                if ($aResp['bStat']) {
                   
                    
                      $newPath = $this->toolsNFe->envDir.$pathinfo['basename'];
            
                       $this->salvarArquivo($newPath, $xml);
                    
                       $aResp['path'] = $newPath;
           
                    
                    return $aResp;
                    
                } else {
                     throw new NfeEnviarException("houve erro !! <br>".$this->toolsNFe->errMsg);
                }
            } else {
                throw new NfeEnviarException("houve erro !! <br>".$this->toolsNFe->errMsg);
            }
            
           
        
    }

    public function consultarNFe($nRec)
    { 
        
        if ($aResp = $this->toolsNFe->getProtocol($nRec)) {

            $prot =  array_shift($aResp['aProt']);
            
            if(!empty($prot))
                return $prot;
            else
                return $aResp;
            
        } else {
            throw new NfeConsultarException($this->toolsNFe->errMsg);
        }
    }

    public function procNFe($chNfe)
    {
        
        $protfile = $this->toolsNFe->temDir . "{$chNfe}-prot.xml";
        $pathEnviada = $this->toolsNFe->envDir ."NFe{$chNfe}.xml";
        
        if ($xml = $this->toolsNFe->addProt($pathEnviada, $protfile)) {
            $path = $this->toolsNFe->aprDir . "NFe{$chNfe}-procNfe.xml";
            $this->salvarArquivo($path, $xml);
            
            return array('chNFe'=>$chNfe,'path'=>$path);
        }
        else
        {
            throw new NfeProcException("Erro ao Gerar arquivo NFe final ");
        }
    }

    public function danfeNFeImprimir($pathXml)
    {
        
        if (is_file($pathXml)) {
            $docxml = file_get_contents($pathXml);
            $danfe = new \DanfeNFePHP($docxml, 'P', 'A4', '../images/logo.jpg', 'I', '');
            $id = $danfe->montaDANFE();
            
            $danfe->printDANFE($id . '.pdf', 'I'); 
            
        }
    }
    
    public function danfeNFeSalvar($pathXml)
    {
         if (is_file($pathXml)) {
            $docxml = file_get_contents($pathXml);
            $pathinfo = pathinfo($pathXml);
            $danfe = new \DanfeNFePHP($docxml, 'P', 'A4', '../images/logo.jpg', 'I', '');
            $id = $danfe->montaDANFE();
            $pdf = $danfe->printDANFE($id . '.pdf', 'S');
            
            $this->salvarArquivo($this->toolsNFe->pdfDir.$pathinfo['filename'].".pdf", $pdf);
        }
    }

    /**
     * 
     * @param type $nAno Ano com dois Digitos
     * @param type $nSerie Serie
     * @param type $nIni numeracao inicial
     * @param type $nFin numeracao final
     * @param type $xJust Justificativa
     */
    public function inutilizarNumeracao($nAno, $nSerie, $nIni, $nFin, $xJust)
    {
        if($xml = $this->toolsNFe->inutNF($nAno, $nSerie, $nIni, $nFin, $xJust))
        {
            $leitor = new \NFEPHP2\NFe\XML\Retornos\LerRetornoInutilizacao($xml);

           return  $leitor->lerRetorno();           
        }
        else
        {
            throw new NfeInutilizarException("Erro ao Inutilizar NFe Msg:<br>".$this->toolsNFe->errMsg,'','');
        }
        
    }
    
    public function cancelarNFe($chNFe,$nProt,$xJust)
    {
        if ($xml = $this->toolsNFe->cancelEvent($chNFe, $nProt, $xJust)) {
          
           $leitor = new \NFEPHP2\NFe\XML\Retornos\LerRetornoCancelamento($xml);

           return  $leitor->lerRetorno();         
           
        } else {
           throw new NfeCancelarException("Erro ao Cancelar NFe:<br>".$this->toolsNFe->errMsg);
        }
    }
    
    public function enviarCCeNfe($chNFe,$xCorrecao,$nSeqEvento)
    {
        
        
        if($xml = $this->toolsNFe->envCCe($chNFe, $xCorrecao, $nSeqEvento)) {
          
            $leitor = new \NFEPHP2\NFe\XML\Retornos\LerRetornoCCe($xml);

            return  $leitor->lerRetorno();    
        }
        else  {
             throw new NfeEnviarCCeException("Erro ao Cancelar NFe:<br>".$this->toolsNFe->errMsg);
        }
        
        
        
    }
    
    public function imprimirCCe($pathXml,$aEnd)
    {
        if (is_file($pathXml)) {
            $cce = new \DacceNFePHP($pathXml, 'P', 'A4', '../images/logo.jpg', 'I', $aEnd, '', 'Times', 1);
            $teste = $cce->printCCe('teste.pdf', 'I');
        }
    }

    private function salvarArquivo($path,$arquivo)
    {
            $f = fopen($path, "w+");

            fwrite($f, $arquivo);

            fclose($f);
            
            return true;
    }

}