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
 * @name      retirada
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Nfe;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * retirada
 * Nível 2 :: F01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class retirada implements NFeGeradorInterface {
    public $CNPJ;      // F02 - CNPJ do local da retirada
    public $xLgr;      // F03 - logradouro do local da retirada
    public $nro;       // F04 - número do local da retirada
    public $xCpl;      // F05 - complemento do local da retirada
    public $xBairro;   // F06 - bairro do local da retirada
    public $cMun;      // F07 - código do município do local da retirada
    public $xMun;      // F08 - nome do município do local da retirada
    public $UF;        // F09 - sigla da UF do local da retirada

  public function __construct() {
    }

    public function getXml(DOMDocument $dom) {
        $F01 = $dom->appendChild($dom->createElement('retirada'));
        $F02 = $F01->appendChild($dom->createElement('CNPJ',       sprintf("%014s", $this->CNPJ)));
        $F03 = $F01->appendChild($dom->createElement('xLgr',       $this->xLgr));
        $F04 = $F01->appendChild($dom->createElement('nro',        $this->nro));
        $F05 = (!empty($this->xCpl)) ? $F01->appendChild($dom->createElement('xCpl',       $this->xCpl)) : '';
        $F06 = $F01->appendChild($dom->createElement('xBairro',    $this->xBairro));
        $F07 = $F01->appendChild($dom->createElement('cMun',       $this->cMun));
        $F08 = $F01->appendChild($dom->createElement('xMun',       $this->xMun));
        $F09 = $F01->appendChild($dom->createElement('UF',         $this->UF));
        return $F01;
    }

}
