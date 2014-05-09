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
 * @name      compra
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Compras;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * compra
 * Nível 2 :: ZB01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 */
class compra implements NFeGeradorInterface {
    public $xNEmp; // ZB02 - nota de empenho
    public $xPed;  // ZB03 - pedido
    public $xCont; // ZB04 - contrato

    public function __construct() {
    }

    public function getXml(DOMDocument $dom)
    {
        $ZB01 = $dom->appendChild($dom->createElement('compra'));
        $ZB02 = (!empty($this->xNEmp))  ? $ZB01->appendChild($dom->createElement('xNEmp',  $this->xNEmp)) : null;
        $ZB02 = (!empty($this->xPed))   ? $ZB01->appendChild($dom->createElement('xPed',   $this->xPed))  : null;
        $ZB02 = (!empty($this->xCont))  ? $ZB01->appendChild($dom->createElement('xCont',  $this->xCont)) : null;
        return $ZB01;
    }

}
