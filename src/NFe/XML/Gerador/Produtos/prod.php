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
 * @name      prod
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * prod
 * Nível 3 :: I01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class prod implements NFeGeradorInterface {
    public $cProd;     // I02 - código do produto ou serviço
    public $cEAN;      // I03 - GTIN (Global Trade Item Number)do produto
    public $xProd;     // I04 - descrição do produto ou serviço
    public $NCM;       // I05 - código NCM
    public $EXTIPI;    // I06 - EX_TIPI
    public $genero;    // I07 - gênero do produto ou serviço
    public $CFOP;      // I08 - código fiscal de operações e prestações
    public $uCom;      // I09 - unidade comercial
    public $qCom;      // I10 - quantidade comercial
    public $vUnCom;    // I10a- valor unitário de comercialização
    public $vProd;     // I11 - valor total bruto dos produtos ou serviços
    public $cEANTrib;  // I12 - GTIN da unidade tributável
    public $uTrib;     // I13 - unidade tributável
    public $qTrib;     // I14 - quantidade tributável
    public $vUnTrib;   // I14a- valor unitário de tributação
    public $vFrete;    // I15 - valor total do frete
    public $vSeg;      // I16 - valor total do seguro
    public $vDesc;     // I17 - valor do desconto
    public $vOutro;     // I17a - Outras despesas acessórias
    public $indTot;     // I17b - Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)
    public $DI;        // I18 - declaração de importação
    public $veicProd;  // J01 - grupo do detalhamento de veículos novos
    public $med;       // K01 - grupo do detalhamento de medicamentos
    public $arma;      // L01 - grupo do detalhamento do armamento
    public $comb;      // L101- grupo de informações para combustíveis líquidos

    public function __construct() {
        $this->DI       = array();
        $this->veicProd = null;
        $this->med      = array();
        $this->arma     = array();
        $this->comb     = null;
    }

    public function addDI(NFeGeradorInterface $obj_DI)
    {
        $this->DI[] = $obj_DI;
        return $this;
    }

    public function addVeicProd(NFeGeradorInterface $obj_veicProd)
    {
        if (!$this->veicProd) {
            $this->veicProd = $obj_veicProd;
            return $this;
        } else {
            return false;
        }
    }

    public function addMed(NFeGeradorInterface $obj_med)
    {
        $this->med[] = $obj_med;
        return $this;
    }

    public function addArma(NFeGeradorInterface $obj_arma)
    {
        $this->arma[] = $obj_arma;
        return $this;
    }

    public function addComb(NFeGeradorInterface $obj_comb)
    {
        if (!$this->comb) {
            $this->comb = $obj_comb;
            return $this;
        } else {
            return false;
        }
    }

    public function getXml (DOMDocument $dom)
    {
        $I01 = $dom->appendChild($dom->createElement('prod'));
        $I02 = $I01->appendChild($dom->createElement('cProd',       $this->cProd));
        $I03 = $I01->appendChild($dom->createElement('cEAN',        $this->cEAN));
        $I04 = $I01->appendChild($dom->createElement('xProd',       $this->xProd));
        $I05 = (!empty($this->NCM))     ? $I01->appendChild($dom->createElement('NCM',     $this->NCM))     : null;
        $I06 = (!empty($this->EXTIPI))  ? $I01->appendChild($dom->createElement('EXTIPI',  $this->EXTIPI))  : null;
        $I07 = (!empty($this->genero))  ? $I01->appendChild($dom->createElement('genero',  $this->genero))  : null;
        $I08 = $I01->appendChild($dom->createElement('CFOP',        $this->CFOP));
        $I09 = $I01->appendChild($dom->createElement('uCom',        $this->uCom));
        $I10 = $I01->appendChild($dom->createElement('qCom',        number_format($this->qCom, 4, ".", "")));
        $I10a= $I01->appendChild($dom->createElement('vUnCom',      number_format($this->vUnCom, 4, ".", "")));
        $I11 = $I01->appendChild($dom->createElement('vProd',       number_format($this->vProd, 2, ".", "")));
        $I12 = $I01->appendChild($dom->createElement('cEANTrib',    $this->cEANTrib));
        $I13 = $I01->appendChild($dom->createElement('uTrib',       $this->uTrib));
        $I14 = $I01->appendChild($dom->createElement('qTrib',       number_format($this->qTrib, 4, ".", "")));
        $I14a= $I01->appendChild($dom->createElement('vUnTrib',     number_format($this->vUnTrib, 4, ".", "")));
        $I15 = ($this->vFrete > 0)  ? $I01->appendChild($dom->createElement('vFrete',  number_format($this->vFrete, 2, ".", "")))  : null;
        $I16 = ($this->vSeg > 0)    ? $I01->appendChild($dom->createElement('vSeg',    number_format($this->vSeg, 2, ".", "")))    : null;
        $I17 = ($this->vDesc > 0)   ? $I01->appendChild($dom->createElement('vDesc',   number_format($this->vDesc, 2, ".", "")))   : null;
        $I17a = ($this->vOutro > 0)   ? $I01->appendChild($dom->createElement('vOutro',   number_format($this->vOutro, 2, ".", "")))   : null;
        $I17b = $I01->appendChild($dom->createElement('indTot',   $this->indTot));
        for ($i=0; $i<count($this->DI); $i++) {
            $I18 = $I01->appendChild($this->DI[$i]->getXml($dom));
        }
        $J01 = (is_object($this->veicProd)) ? $I01->appendChild($this->veicProd->getXml($dom)) : null;
        for ($i=0; $i<count($this->med); $i++) {
            $K01 = $I01->appendChild($this->med[$i]->getXml($dom));
        }
        for ($i=0; $i<count($this->arma); $i++) {
            $L01 = $I01->appendChild($this->arma[$i]->getXml($dom));
        }
        $L101= (is_object($this->comb)) ? $I01->appendChild($this->comb->getXml($dom)) : null;
        return $I01;
    }

}
