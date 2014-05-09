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
 * @name      adi
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * adi
 * Nível 5 :: I25
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class adi implements NFeGeradorInterface {
    public $nAdicao;       // I26 - número da adição
    public $nSeqAdic;      // I27 - número sequencial do item dentro da adição
    public $cFabricante;   // I28 - código do fabricante estrangeiro
    public $vDescDI;       // I29 - valor do desconto do item da DI - adição

    function __construct() {
    }

    public function getXml(DOMDocument $dom)
    {
        $I25 = $dom->appendChild($dom->createElement('adi'));
        $I26 = $I25->appendChild($dom->createElement('nAdicao',     $this->nAdicao));
        $I27 = $I25->appendChild($dom->createElement('nSeqAdic',    $this->nSeqAdic));
        $I28 = $I25->appendChild($dom->createElement('cFabricante', $this->cFabricante));
        $I29 = (isset($this->vDescDI)) ? $I25->appendChild($dom->createElement('vDescDI',     number_format($this->vDescDI, 2, ".", ""))) : null;
        return $I25;
    }

}
