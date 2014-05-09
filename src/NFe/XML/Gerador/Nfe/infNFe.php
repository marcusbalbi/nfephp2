<?php
/**
 * Este arquivo é parte do projeto NFePHP - Nota Fiscal eletrônica em PHP.
 *
 * Este programa é um software livre: você pode redistribuir e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU como é publicada pela Fundação 
 * para o Software Livre, na versão 3 da licença, ou qualquer versão posterior.
 *
 * Este programa é distribuído na esperança que será útil, mas SEM NENHUMA
 * GARANTIA; sem mesmo a garantia explícita do VALOR COMERCIAL ou ADEQUAÇÃO PARA
 * UM PROPÓSITO EM PARTICULAR, veja a Licença Pública Geral GNU para mais
 * detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Publica GNU junto com este
 * programa. Caso contrário consulte <http://www.fsfla.org/svnwiki/trad/GPLv3>.
 *
 * @package   NFePHP
 * @name      infNFe
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Nfe;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
use NFEPHP2\NFe\XML\Gerador\Emitente\emit;
use NFEPHP2\NFe\XML\Gerador\Destinatario\dest;
use NFEPHP2\NFe\XML\Gerador\Adicionais\infAdic;
use NFEPHP2\NFe\XML\Gerador\Exterior\exporta;
use NFEPHP2\NFe\XML\Gerador\Compras\compra;
/**
 * infNFe
 * Nível 1 :: A01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class infNFe implements NFeGeradorInterface {
    public $versao;        // A02 - versão do leiaute
    public $Id;            // A03 - identificador da TAG a ser assinada
    
    /**
     *
     * @var ide
     */
    public $ide;           // B01 - grupo das informações de identificação da NFe
    public $emit;          // C01 - grupo de identificação do emitente da NFe
    public $avulsa;        // D01 - informações do fisco emitente
    public $dest;          // E01 - grupo de identificação do destinatário da NFe
    public $retirada;      // F01 - grupo de identificação do local de retirada
    public $entrega;       // G01 - grupo de identificação do local de entrega
    public $det;           // H01 - grupo do detalhamento de prod. e serv. da NFe
    public $total;         // W01 - grupo de valores totais da NFe
    public $transp;        // X01 - grupo de informação do transporte da NFe
    public $cobr;          // Y01 - grupo de cobrança
    public $infAdic;       // Z01 - grupo de informações adicionais
    public $exporta;       // ZA01- grupo de exportação
    public $compra;        // ZB01- grupo de compra
    public $Signature;     // ZC01- assinatura XML da NFe segundo padrão digital

  public function __construct() {
        $this->versao       = '1.10';
        $this->ide          = null;
        $this->emit         = null;
        $this->avulsa       = null;
        $this->dest         = null;
        $this->retirada     = null;
        $this->entrega      = null;
        $this->det          = array();
        $this->total        = null;
        $this->transp       = null;
        $this->cobr         = null;
        $this->infAdic      = null;
        $this->exporta      = null;
        $this->compra       = null;
        $this->Signature    = null;
    }

    public function addIde($obj_ide) {
        if (!$this->ide) {
            $this->ide = $obj_ide;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addEmit($objEmit) {
        if (!$this->emit) {
            $this->emit = $objEmit;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addDest($objDest) {
        if (!$this->dest) {
            $this->dest = $objDest;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addTotal($objTotal) {
        if (!$this->total) {
            $this->total = $objTotal;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addTransp($objTransp)
    {
          if (!$this->transp) {
            $this->transp = $objTransp;
            return $this;
        } else {
            return false;
        }
    }

    public function addAvulsa($obj_avulsa) {
        if (!$this->avulsa) {
            $this->avulsa = $obj_avulsa;
            return $this;
        } else {
            return false;
        }
    }

  public function addRetirada($obj_retirada) {
        if (!$this->retirada) {
            $this->retirada = $obj_retirada;
            return $this;
        } else {
            return false;
        }
    }

  public function addEntrega($obj_entrega) {
        if (!$this->entrega) {
            $this->entrega = $obj_entrega;
            return $this;
        } else {
            return false;
        }
    }

  public function addDet($obj_det) {
        $this->det[] = $obj_det;
        return $this;
    }

  public function addCobr($obj_cobr) {
        if (!$this->cobr) {
            $this->cobr = $obj_cobr;
            return $this;
        } else {
            return false;
        }
    }

  public function addInfAdic($obj_infAdic) {
        if (!$this->infAdic) {
            $this->infAdic = $obj_infAdic;
            return $this;
        } else {
            return false;
        }
    }

  public function addExporta($obj_exporta) {
        if (!$this->exporta) {
            $this->exporta = $obj_exporta;
            return $this;
        } else {
            return false;
        }
    }

  public function addCompra($obj_compra) {
        if (!$this->compra) {
            $this->compra = $obj_compra;
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Calcula digito verificador para chave de acesso de 43 dígitos
     * conforme manual, pág. 72
     */
  public function calcula_dv($chave43) {
    $multiplicadores = array(2,3,4,5,6,7,8,9);
    $i = 42;
    $soma_ponderada = 0;
    while ($i >= 0) {
        for ($m=0; $m<count($multiplicadores) && $i>=0; $m++) {
            $soma_ponderada+= $chave43[$i] * $multiplicadores[$m];
            $i--;
        }
    }
    $resto = $soma_ponderada % 11;
    if ($resto == '0' || $resto == '1') {
            $this->ide->cDV = 0;
    } else {
            $this->ide->cDV = 11 - $resto;
   }
        return $this->ide->cDV;
}

  public function getChaveAcesso() {

        // 02 - cUF  - código da UF do emitente do Documento Fiscal
        $chave = sprintf("%02d", $this->ide->cUF);

        // 04 - AAMM - Ano e Mes de emissão da NF-e
        $chave.= sprintf("%04d", substr($this->ide->dEmi, 2, 2).substr($this->ide->dEmi, 5, 2));

        // 14 - CNPJ - CNPJ do emitente
        $chave.= sprintf("%014s", $this->emit->CNPJ);

        // 02 - mod  - Modelo do Documento Fiscal
        $chave.= sprintf("%02d", $this->ide->mod);

        // 03 - serie - Série do Documento Fiscal
        $chave.= sprintf("%03d", $this->ide->serie);

        // 09 - nNF  - Número do Documento Fiscal
        $chave.= sprintf("%09d", $this->ide->nNF);
        
        $chave.= sprintf("%1d",$this->ide->tpEmis);

        // 09 - cNF  - Código Numérico que compõe a Chave de Acesso
        $chave.= sprintf("%08d", $this->ide->cNF);

        // 01 - cDV  - Dígito Verificador da Chave de Acesso
        $chave.= $this->calcula_dv($chave);

        return $chave;
      
    }
    
    protected function geraCN($length = 8) {
        $numero = '';
        for ($x = 0; $x < $length; $x++) {
            $numero .= rand(0, 9);
        }
        return $numero;
    }

    public function getXml(DOMDocument $dom) {
        
        $A01 = $dom->appendChild($dom->createElement('infNFe'));
         
        $A02 = $A01->appendChild($dom->createAttribute('versao'));
               $A02->appendChild($dom->createTextNode($this->versao));
                
        $A03 = $A01->appendChild($dom->createAttribute('Id'));
               $A03->appendChild($dom->createTextNode($this->Id = "NFe".$this->getChaveAcesso()));
        $B01 = $A01->appendChild($this->ide->getXml($dom));  
        
        $C01 = $A01->appendChild($this->emit->getXml($dom));
        $D01 = (is_object($this->avulsa))   ? $A01->appendChild($this->avulsa->getXml($dom))   : null;
        $E01 = $A01->appendChild($this->dest->getXml($dom));
        $F01 = (is_object($this->retirada)) ? $A01->appendChild($this->retirada->getXml($dom)) : null;
        $G01 = (is_object($this->entrega))  ? $A01->appendChild($this->entrega->getXml($dom))  : null;
        for ($i=0; $i<count($this->det); $i++) {
            $H01 = $A01->appendChild($this->det[$i]->getXml($dom));
        }
        $W01 = $A01->appendChild($this->total->getXml($dom));
        $X01 = $A01->appendChild($this->transp->getXml($dom));
        $Y01 = (is_object($this->cobr))     ? $A01->appendChild($this->cobr->getXml($dom))     : null;
        $Z01 = (is_object($this->infAdic))  ? $A01->appendChild($this->infAdic->getXml($dom))  : null;
        $ZA01= (is_object($this->exporta))  ? $A01->appendChild($this->exporta->getXml($dom))  : null;
        $ZB01= (is_object($this->compra))   ? $A01->appendChild($this->compra->getXml($dom))   : null;
        // BUG: assinado posteriormente por NFe_utils
        //$ZC01= (is_object($this->Signature) ? $A01->appendChild($this->Signature->getXml($dom)) : null;
        
        return $A01;
    }

}
