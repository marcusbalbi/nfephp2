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
 * @name      ICMSInter
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ICMSInter
 * Nível 5 :: L114
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi
 */
class icmsInter implements NFeGeradorInterface {
    public $vBCICMSSTDest; // L115 - BC do ICMS ST da UF de destino
    public $vICMSSTDest;   // L116 - valor do ICMS ST da UF de destino

    function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) {
        $L114 = $dom->appendChild($dom->createElement('ICMSInter'));
        $L115 = $L114->appendChild($dom->createElement('vBCICMSSTDest', $this->vBCICMSSTDest));
        $L116 = $L114->appendChild($dom->createElement('vICMSSTDest',   $this->vICMSSTDest));
        return $L114;
    }

}
