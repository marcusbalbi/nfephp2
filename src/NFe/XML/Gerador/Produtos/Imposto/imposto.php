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
 * @name      imposto
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * imposto
 * Nível 3 :: M01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class imposto implements NFeGeradorInterface {
    /**
     *
     * @var icms
     */
    public $ICMS;      // N01 - grupo de ICMS da operação própria e ST
    
    /**
     *
     * @var ipi
     */
    public $IPI;       // O01 - grupo de IPI
    
    /**
     *
     * @var ii
     */
    public $II;        // P01 - grupo de imposto de importação
    
    /**
     *
     * @var pis
     */
    public $PIS;       // Q01 - grupo do PIS
    
    /**
     *
     * @var pisst
     */
    public $PISST;     // R01 - grupo de PIS substituição tributária
    
    /**
     *
     * @var cofins
     */
    public $COFINS;    // S01 - grupo de COFINS
    
    /**
     *
     * @var cofinsst
     */
    public $COFINSST;  // T01 - grupo de COFINS substituição tributária
    
    /**
     *
     * @var issqn
     */
    public $ISSQN;     // U01 - grupo do ISSQN
    
    
    public $vTotTrib; //M02 -  Valor aproximado total de tributos federais, estaduais e municipais 


    function __construct() {
        $this->ICMS     = new icms;
        $this->IPI      = null;
        $this->II       = null;
        $this->PIS      = new pis;
        $this->PISST    = null;
        $this->COFINS   = new cofins;
        $this->COFINSST = null;
        $this->ISSQN    = null;
    }

    public function addIPI(NFeGeradorInterface $obj_IPI)
    {
        if (!$this->IPI) {
            $this->IPI = $obj_IPI;
            return $this;
        } else {
            return false;
        }
    }

    public function addII(NFeGeradorInterface $obj_II)
    {
        if (!$this->II) {
            $this->II = $obj_II;
            return $this;
        } else {
            return false;
        }
    }

    public function addPISST(NFeGeradorInterface $obj_PISST)
    {
        if (!$this->PISST) {
            $this->PISST = $obj_PISST;
            return $this;
        } else {
            return false;
        }
    }

    public function addCOFINSST(NFeGeradorInterface $obj_COFINSST)
    {
        if (!$this->COFINSST) {
            $this->COFINSST = $obj_COFINSST;
            return $this;
        } else {
            return false;
        }
    }

    public function addISSQN(NFeGeradorInterface $obj_ISSQN)
    {
        if (!$this->ISSQN) {
            $this->ISSQN = $obj_ISSQN;
            return $this;
        } else {
            return false;
        }
    }

    public function getXml(DOMDocument $dom) {
        $M01 = $dom->appendChild($dom->createElement('imposto'));
        $M02 = (!empty($this->vTotTrib)) ? $M01->appendChild($dom->createElement('vTotTrib', $this->vTotTrib)) : '';
        $N01 = $M01->appendChild($this->ICMS->getXml($dom));
        $O01 = (is_object($this->IPI)) ? $M01->appendChild($this->IPI->getXml($dom)) : null;
        $P01 = (is_object($this->II)) ? $M01->appendChild($this->II->getXml($dom)) : null;
        $Q01 = $M01->appendChild($this->PIS->getXml($dom));
        $R01 = (is_object($this->PISST)) ? $M01->appendChild($this->PISST->getXml($dom)) : null;
        $S01 = $M01->appendChild($this->COFINS->getXml($dom));
        $T01 = (is_object($this->COFINSST)) ? $M01->appendChild($this->COFINSST->getXml($dom)) : null;
        $U01 = (is_object($this->ISSQN)) ? $M01->appendChild($this->ISSQN->getXml($dom)) : null;
        return $M01;
    }

}
