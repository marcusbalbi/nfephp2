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
 * @name      transporta
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Transportadora;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * transporta
 * Nível 3 :: X03
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class transporta implements NFeGeradorInterface {
    public $CNPJ;      // X04 - CNPJ
    public $CPF;       // X05 - CPF
    public $xNome;     // X06 - razão social ou nome
    public $IE;        // X07 - inscrição estadual
    public $xEnder;    // X08 - endereço completo
    public $xMun;      // X09 - nome do município
    public $UF;        // X10 - sigla da UF

    public function __construct() {
    }

    public function getXml(DOMDocument $dom) {
        $X03 = $dom->appendChild($dom->createElement('transporta'));
        
        if(empty($this->CPF) && empty($this->CNPJ)) {
            $X04 = null;
        }
        else
            $X04 = (empty($this->CPF)) ? $X03->appendChild($dom->createElement('CNPJ', sprintf("%014s", $this->CNPJ))) : $X03->appendChild($dom->createElement('CPF', sprintf("%011s", $this->CPF)));
        
        //X05 - ou exclusivo com X04
        $X06 = (!empty($this->xNome))   ? $X03->appendChild($dom->createElement('xNome',    $this->xNome))  : null;
        $X07 = (!empty($this->IE))      ? $X03->appendChild($dom->createElement('IE',       $this->IE))     : null;
        $X08 = (!empty($this->xEnder))  ? $X03->appendChild($dom->createElement('xEnder',   $this->xEnder)) : null;
        $X09 = (!empty($this->xMun))    ? $X03->appendChild($dom->createElement('xMun',     $this->xMun))   : null;
        $X10 = (!empty($this->UF))      ? $X03->appendChild($dom->createElement('UF',       $this->UF))     : null;
        return $X03;
    }

}
