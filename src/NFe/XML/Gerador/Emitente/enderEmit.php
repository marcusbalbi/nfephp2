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
 * @name      enderEmit
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Emitente;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * enderEmit
 * Nível 3 :: C05
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class enderEmit implements NFeGeradorInterface {
    public $xLgr;      // C06 - logradouro do emitente
    public $nro;       // C07 - número do emitente
    public $xCpl;      // C08 - complemento do emitente
    public $xBairro;   // C09 - bairro do emitente
    public $cMun;      // C10 - código do município do emitente
    public $xMun;      // C11 - nome do município do emitente
    public $UF;        // C12 - sigla da UF do emitente
    public $CEP;       // C13 - código do CEP do emitente
    public $cPais;     // C14 - código do País (1058 - Brasil) do emitente
    public $xPais;     // C15 - nome do País (Brasil ou BRASIL) do emitente
    public $fone;      // C16 - telefone do emitente

    public function __construct() {
        $this->cPais    = 1058;
        $this->xPais    = "BRASIL";
    }
    
    public function getXml(DOMDocument $dom) {

        $C05 = $dom->appendChild($dom->createElement('enderEmit'));
        $C06 = $C05->appendChild($dom->createElement('xLgr', $this->xLgr));
        $C07 = $C05->appendChild($dom->createElement('nro', $this->nro));
        $C08 = (!empty($this->xCpl)) ? $C05->appendChild($dom->createElement('xCpl', $this->xCpl)) : null;
        $C09 = $C05->appendChild($dom->createElement('xBairro', $this->xBairro));
        $C10 = $C05->appendChild($dom->createElement('cMun', $this->cMun));
        $C11 = $C05->appendChild($dom->createElement('xMun', $this->xMun));
        $C12 = $C05->appendChild($dom->createElement('UF', $this->UF));
        $C13 = (!empty($this->CEP)) ? $C05->appendChild($dom->createElement('CEP', sprintf("%08s", $this->CEP))) : null;
        $C14 = (!empty($this->cPais)) ? $C05->appendChild($dom->createElement('cPais', $this->cPais)) : null;
        $C15 = (!empty($this->xPais)) ? $C05->appendChild($dom->createElement('xPais', $this->xPais)) : null;
        $C16 = (!empty($this->fone)) ? $C05->appendChild($dom->createElement('fone', $this->fone)) : null;
        return $C05;
    }

}
