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
 * @name      COFINSST
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * COFINSST
 * Nível 4 :: T01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class cofinsst implements NFeGeradorInterface {
    public $vBC;       // T02 - valor da BC do COFINS
    public $pCOFINS;   // T03 - alíquota do COFINS (em percentual)
    public $qBCProd;   // T04 - quantidade vendida
    public $vAliqProd; // T05 - alíquota do COFINS (em reias)
    public $vCOFINS;   // T06 - valor do COFINS

    function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom)
    {
        $T01 = $dom->appendChild($dom->createElement('COFINSST'));
        if (isset($this->vBC) && isset($this->pCOFINS)) {
            $T02 = $T01->appendChild($dom->createElement('vBC',         number_format($this->vBC, 2, ".", "")));
            $T03 = $T01->appendChild($dom->createElement('pCOFINS',     number_format($this->pCOFINS, 2, ".", "")));
        } else {
            $T04 = $T01->appendChild($dom->createElement('qBCProd',     number_format($this->qBCProd, 4, ".", "")));
            $T05 = $T01->appendChild($dom->createElement('vAliqProd',   number_format($this->vAliqProd, 4, ".", "")));
        }
        $T06 = $T01->appendChild($dom->createElement('vCOFINS',     number_format($this->vCOFINS, 2, ".", "")));
        return $T01;
    }

}
