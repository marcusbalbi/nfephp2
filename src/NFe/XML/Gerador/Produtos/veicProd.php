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
 * @name      veicProd
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * veicProd
 * Nível 4 :: J01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class veicProd implements NFeGeradorInterface {
    public $tpOp;      // J02 - tipo da operação
    public $chassi;    // J03 - chassi do veículo
    public $cCor;      // J04 - cor
    public $xCor;      // J05 - descrição da cor
    public $pot;       // J06 - potência do motor
    public $CM3;       // J07 - CM3 (potência)
    public $pesoL;     // J08 - peso líquido
    public $pesoB;     // J09 - peso bruto
    public $nSerie;    // J10 - serial
    public $tpComb;    // J11 - tipo de combustível
    public $nMotor;    // J12 - número do motor
    public $CMKG;      // J13 - CMKG
    public $dist;      // J14 - distância entre eixos
    public $RENAVAM;   // J15 - RENAVAM
    public $anoMod;    // J16 - ano modelo de fabricação
    public $anoFab;    // J17 - ano de fabricação
    public $tpPint;    // J18 - tipo de pintura
    public $tpVeic;    // J19 - tipo de veículo
    public $espVeic;   // J20 - espécie de veículo
    public $VIN;       // J21 - condição do VIN
    public $condVeic;  // J22 - condição do veículo
    public $cMod;      // J23 - código marca modelo

    function __construct() {
    }
    
    public function getXml(DOMDocument $dom)
    {
        $J01 = $dom->appendChild($dom->createElement('veicProd'));
        $J02 = $J01->appendChild($dom->createElement('tpOp',        $this->tpOp));
        $J03 = $J01->appendChild($dom->createElement('chassi',      $this->chassi));
        $J04 = $J01->appendChild($dom->createElement('cCor',        $this->cCor));
        $J05 = $J01->appendChild($dom->createElement('xCor',        $this->xCor));
        $J06 = $J01->appendChild($dom->createElement('pot',         $this->pot));
        $J07 = $J01->appendChild($dom->createElement('CM3',         $this->CM3));
        $J08 = $J01->appendChild($dom->createElement('pesoL',       $this->pesoL));
        $J09 = $J01->appendChild($dom->createElement('pesoB',       $this->pesoB));
        $J10 = $J01->appendChild($dom->createElement('nSerie',      $this->nSerie));
        $J11 = $J01->appendChild($dom->createElement('tpComb',      $this->tpComb));
        $J12 = $J01->appendChild($dom->createElement('nMotor',      $this->nMotor));
        $J13 = $J01->appendChild($dom->createElement('CMKG',        $this->CMKG));
        $J14 = $J01->appendChild($dom->createElement('dist',        $this->dist));
        $J15 = (!empty($this->RENAVAM)) ? $J01->appendChild($dom->createElement('RENAVAM',     $this->RENAVAM)) : null;
        $J16 = $J01->appendChild($dom->createElement('anoMod',      $this->anoMod));
        $J17 = $J01->appendChild($dom->createElement('anoFab',      $this->anoFab));
        $J18 = $J01->appendChild($dom->createElement('tpPint',      $this->tpPint));
        $J19 = $J01->appendChild($dom->createElement('tpVeic',      $this->tpVeic));
        $J20 = $J01->appendChild($dom->createElement('espVeic',     $this->espVeic));
        $J21 = $J01->appendChild($dom->createElement('VIN',         $this->VIN));
        $J22 = $J01->appendChild($dom->createElement('condVeic',    $this->condVeic));
        $J23 = $J01->appendChild($dom->createElement('cMod',        $this->cMod));
        return $J01; 
    }

}
