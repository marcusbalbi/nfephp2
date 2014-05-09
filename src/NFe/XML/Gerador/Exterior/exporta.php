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
 * @name      exporta
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Exterior;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * exporta
 * Nível 2 :: ZA01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class exporta implements NFeGeradorInterface {
    public $UFEmbarq;      // ZA02 - sigla da UF do embarque dos produtos
    public $xLocEmbarq;    // ZA03 - local onde ocorrerá o embarque dos produtos

    public function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) {
        $ZA01 = $dom->appendChild($dom->createElement('exporta'));
        $ZA02 = $ZA01->appendChild($dom->createElement('UFEmbarq',    $this->UFEmbarq));
        $ZA03 = $ZA01->appendChild($dom->createElement('xLocEmbarq',  $this->xLocEmbarq));
        return $ZA01;
    }

}
