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
 * @name      ISSQN
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ISSQN
 * Nível 4 :: U01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class issqn implements NFeGeradorInterface {
    public $vBC;       // U02 - valor da BC do ISSQN
    public $vAliq;     // U03 - alíquota do ISSQN
    public $vISSQN;    // U04 - valor do ISSQN
    public $cMunFG;    // U05 - código do município do fato gerador do ISSQN
    public $cListServ; // U06 - código da lista de serviços

    function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom) {
        $U01 = $dom->appendChild($dom->createElement('ISSQN'));
        $U02 = $U01->appendChild($dom->createElement('vBC',         number_format($this->vBC, 2, ".", "")));
        $U03 = $U01->appendChild($dom->createElement('vAliq',       number_format($this->vAliq, 2, ".", "")));
        $U04 = $U01->appendChild($dom->createElement('vISSQN',      number_format($this->vISSQN, 2, ".", "")));
        $U05 = $U01->appendChild($dom->createElement('cMunFG',      $this->cMunFG));
        $U06 = $U01->appendChild($dom->createElement('cListServ',   $this->cListServ));
        return $U01;
    }

}
