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
 * @name      ICMSComb
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ICMSComb
 * Nível 5 :: L109
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 */
class icmsComb implements NFeGeradorInterface {
    public $vBCIMCS;   // L110 - BC do ICMS
    public $vICMS;     // L111 - valor do ICMS
    public $vBCICMSST; // L112 - BC do ICMS ST retido
    public $vICMSST;   // L113 - valor do ICMS ST retido

    public function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) {
        $L109 = $dom->appendChild($dom->createElement('ICMSComb'));
        $L110 = $L109->appendChild($dom->createElement('vBCIMCS',   $this->vBCICMS));
        $L111 = $L109->appendChild($dom->createElement('vICMS',     $this->vICMS));
        $L112 = $L109->appendChild($dom->createElement('vBCICMSST', $this->vBCICMSST));
        $L113 = $L109->appendChild($dom->createElement('vICMSST',   $this->vICMSST));
        return $L109;
    }

}
