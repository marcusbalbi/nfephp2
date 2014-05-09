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
 * @name      ICMSTot
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Totais;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ICMSTot
 * Nível 3 :: W02
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class icmsTot implements NFeGeradorInterface {
    public $vBC;       // W03 - base de cáculo para ICMS
    public $vICMS;     // W04 - valor total do ICMS
    public $vBCST;     // W05 - base de cálculo para ICMS ST
    public $vST;       // W06 - valor total do ICMS ST
    public $vProd;     // W07 - valor total dos produtos e serviços
    public $vFrete;    // W08 - valor total do frete
    public $vSeg;      // W09 - valor total do seguro
    public $vDesc;     // W10 - valor total do desconto
    public $vII;       // W11 - valor total do II
    public $vIPI;      // W12 - valor total do IPI
    public $vPIS;      // W13 - valor total do PIS
    public $vCOFINS;   // W14 - valor total do COFINS
    public $vOutro;    // W15 - outras despesas acessórias
    public $vNF;       // W16 - valor total da NFe

    public function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) {
        $W02 = $dom->appendChild($dom->createElement('ICMSTot'));
        $W03 = $W02->appendChild($dom->createElement('vBC', number_format($this->vBC, 2, ".", "")));
        $W04 = $W02->appendChild($dom->createElement('vICMS', number_format($this->vICMS, 2, ".", "")));
        $W05 = $W02->appendChild($dom->createElement('vBCST', number_format($this->vBCST, 2, ".", "")));
        $W06 = $W02->appendChild($dom->createElement('vST', number_format($this->vST, 2, ".", "")));
        $W07 = $W02->appendChild($dom->createElement('vProd', number_format($this->vProd, 2, ".", "")));
        $W08 = $W02->appendChild($dom->createElement('vFrete', number_format($this->vFrete, 2, ".", "")));
        $W09 = $W02->appendChild($dom->createElement('vSeg', number_format($this->vSeg, 2, ".", "")));
        $W10 = $W02->appendChild($dom->createElement('vDesc', number_format($this->vDesc, 2, ".", "")));
        $W11 = $W02->appendChild($dom->createElement('vII', number_format($this->vII, 2, ".", "")));
        $W12 = $W02->appendChild($dom->createElement('vIPI', number_format($this->vIPI, 2, ".", "")));
        $W13 = $W02->appendChild($dom->createElement('vPIS', number_format($this->vPIS, 2, ".", "")));
        $W14 = $W02->appendChild($dom->createElement('vCOFINS', number_format($this->vCOFINS, 2, ".", "")));
        $W15 = $W02->appendChild($dom->createElement('vOutro', number_format($this->vOutro, 2, ".", "")));
        $W16 = $W02->appendChild($dom->createElement('vNF', number_format($this->vNF, 2, ".", "")));
        return $W02;
    }

}
