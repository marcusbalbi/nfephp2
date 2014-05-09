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
 * @name      comb
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * comb
 * Nível 4 :: L101
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class comb implements NFeGeradorInterface {
    public $cProdANP;      // L102 - código de produto da ANP
    public $CODIF;         // L103 - código de autorização / registro do CODIF
    public $qTemp;         // L104 - quantidade de combustível faturada
    public $CIDE;          // L105 - grupo da CIDE
    public $ICMSComb;      // L109 - grupo do ICMSComb
    public $ICMSInter;     // L114 - grupo do ICMSST de operação interestadual
    public $ICMSCons;      // L117 - ICMS consumo em UF diferente da UF do destinat

    public function __construct() {
        $this->CIDE         = null;
        $this->ICMSComb     = new ICMSComb;
        $this->ICMSInter    = null;
        $this->ICMSCons     = null;
    }

    public function addCIDE(NFeGeradorInterface $obj_CIDE)
    {
        if (!$this->CIDE) {
            $this->CIDE = $obj_CIDE;
            return $this;
        } else {
            return false;
        }
    }

    public function addICMSInter(NFeGeradorInterface $obj_ICMSInter)
    {
        if (!$this->ICMSInter) {
            $this->ICMSInter = $obj_ICMSInter;
            return $this;
        } else {
            return false;
        }
    }

    public function addICMSCons(NFeGeradorInterface$obj_ICMSCons)
    {
        if (!$this->ICMSCons) {
            $this->ICMSCons = $obj_ICMSCons;
            return $this;
        } else {
            return false;
        }
    }
    
    public function getXml(DOMDocument $dom)
    {
        $L101 = $dom->appendChild($dom->createElement('comb'));
        $L102 = $L101->appendChild($dom->createElement('cProdANP',  $this->cProdANP));
        $L103 = $L101->appendChild($dom->createElement('CODIF',     $this->CODIF));
        $L104 = $L101->appendChild($dom->createElement('qTemp',     $this->qTemp));
        $L105 = (is_object($this->CIDE)) ? $L101->appendChild($this->CIDE->getXml($dom)) : null;
        $L109 = $L101->appendChild($this->ICMSComb->getXml($dom));
        $L114 = (is_object($this->ICMSInter)) ? $L101->appendChild($this->ICMSInter->getXml($dom)) : null;
        $L117 = (is_object($this->ICMSCons)) ? $L101->appendChild($this->ICMSCons->getXml($dom)) : null;
        return $L101;
    }

}
