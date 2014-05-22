<?php
/**
 * Este arquivo é parte do projeto NFePHP - Nota Fiscal eletrônica em PHP.
 *
 * Este programa é um software livre: você pode redistribuir e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU (GPL)como é publicada pela Fundação
 * para o Software Livre, na versão 3 da licença, ou qualquer versão posterior
 * e/ou
 * sob os termos da Licença Pública Geral Menor GNU (LGPL) como é publicada pela Fundação
 * para o Software Livre, na versão 3 da licença, ou qualquer versão posterior.
 *
 * Este programa é distribuído na esperança que será útil, mas SEM NENHUMA
 * GARANTIA; nem mesmo a garantia explícita definida por qualquer VALOR COMERCIAL
 * ou de ADEQUAÇÃO PARA UM PROPÓSITO EM PARTICULAR,
 * veja a Licença Pública Geral GNU para mais detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Publica GNU e da
 * Licença Pública Geral Menor GNU (LGPL) junto com este programa.
 * Caso contrário consulte <http://www.fsfla.org/svnwiki/trad/GPLv3> ou
 * <http://www.fsfla.org/svnwiki/trad/LGPLv3>.
 *
 * Está atualizada para :
 *      PHP 5.3
 *
 * Esta é a classe principal para a geração, controle e comunicação dos
 * Conhecimentos de Transporte Eletrônicos CTe
 *
 * @package   NFePHP2
 * @name      NFeFacade
 * @version   1.0.19
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009-2012 &copy; CTePHP
 * @link      http://www.nfephp.org/
 * @author    Marcus V. Balbi <marcusbalbi@hotmail.com>
 *
 *
 *
 */

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

        try
        {
            if(empty($config))
            {
                throw new Exception("Configuração Vazia");
            }
            
          
         $this->dir =  realpath(dirname(__FILE__));
         $this->toolsNFe = new ToolsNFePHP ($config);
        }
        catcH(Exception $e)
        {
            throw $e;
        }
        
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
        try
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
        catcH(Exception $e)
        {
            throw $e;
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

    public function danfeNFeImprimir($chNFe,$sOrientacao = '', $sPapel = '', $sPathLogo = '')
    {
        $pathXml = $this->toolsNFe->aprDir."/NFe{$chNFe}-procNfe.xml";
     
        if (is_file($pathXml)) {
            $docxml = file_get_contents($pathXml);
            
            $danfe = new \DanfeNFePHP($docxml, $sOrientacao, $sPapel, $sPathLogo, 'I', '');
            
            $id = $danfe->montaDANFE();
            
            $danfe->printDANFE($id . '.pdf', 'I'); 
           
        }
    }
    
    public function danfeNFeSalvar($chNFe,$sOrientacao = '', $sPapel = '', $sPathLogo = '')
    {
         $pathXml = $this->toolsNFe->aprDir."/NFe{$chNFe}-procNfe.xml";
        
         if (is_file($pathXml)) {
            $docxml = file_get_contents($pathXml);
            $pathinfo = pathinfo($pathXml);
            $danfe = new \DanfeNFePHP($docxml ,$sOrientacao = '', $sPapel = '', $sPathLogo = '');
            $id = $danfe->montaDANFE();
            $pdf = $danfe->printDANFE($id . '.pdf', 'S');
            
            $this->salvarArquivo($this->toolsNFe->pdfDir.$pathinfo['filename'].".pdf", $pdf);
            
            return $this->toolsNFe->pdfDir.$pathinfo['filename'].".pdf";
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
            throw new NfeInutilizarException("Erro ao Inutilizar NFe Msg:<br>".$this->toolsNFe->errMsg);
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
             throw new NfeEnviarCCeException("Erro ao enviar CCe NFe:<br>".$this->toolsNFe->errMsg);
        }
        
        
        
    }
    
    public function imprimirCCe($chNFe,$nSeqEvento,$aEnd)
    {
        $pathXml = $this->toolsNFe->cccDir."/{$chNFe}-{$nSeqEvento}-procCCe.xml";
        
        if (is_file($pathXml)) {
            $cce = new \DacceNFePHP($pathXml, 'P', 'A4', '../images/logo.jpg', 'I', $aEnd, '', 'Times', 1);
           
            return $cce->printCCe('{$chNFe}-{$nSeqEvento}-procCCe.pdf', 'I');
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
