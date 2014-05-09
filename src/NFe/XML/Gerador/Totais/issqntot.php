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
 * @name      ISSQNtot
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Totais;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ISSQNtot
 * Nível 3 :: W17
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class issqnTot implements NFeGeradorInterface {
    public $vServ;     // W18 - valor total dos serviços não tributados pelo ICMS
    public $vBC;       // W19 - base de cálculo do ISS
    public $vISS;      // W20 - valor total do ISS
    public $vPIS;      // W21 - valor do PIS sobre serviços
    public $vCOFINS;   // W22 - valor do COFINS sobre serviços

    public function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) 
    {
        $W17 = $dom->appendChild($dom->createElement('ISSQNtot'));
        $W18 = (isset($this->vServ))   ? $W17->appendChild($dom->createElement('vServ',   number_format($this->vServ, 2, ".", "")))   : null;
        $W19 = (isset($this->vBC))     ? $W17->appendChild($dom->createElement('vBC',     number_format($this->vBC, 2, ".", "")))     : null;
        $W20 = (isset($this->vISS))    ? $W17->appendChild($dom->createElement('vISS',    number_format($this->vISS, 2, ".", "")))    : null;
        $W21 = (isset($this->vPIS))    ? $W17->appendChild($dom->createElement('vPIS',    number_format($this->vPIS, 2, ".", "")))    : null;
        $W22 = (isset($this->vCOFINS)) ? $W17->appendChild($dom->createElement('vCOFINS', number_format($this->vCOFINS, 2, ".", ""))) : null;
        return $W17;
    }

}
