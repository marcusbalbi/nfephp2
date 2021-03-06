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
 * @name      II
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * II
 * Nível 4 :: P01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class ii implements NFeGeradorInterface {
    public $vBC;       // P02 - valor da BC do imposto de importação
    public $vDespAdu;  // P03 - valor das despesas aduaneiras
    public $vII;       // P04 - valor do imposto de importação
    public $vIOF;      // P05 - valor do imposto sobre operações financeiras

    function __construct() 
    {
        
    }

    public function getXml(DOMDocument $dom) 
    {
        $P01 = $dom->appendChild($dom->createElement('II'));
        $P02 = $P01->appendChild($dom->createElement('vBC',         number_format($this->vBC, 2, ".", "")));
        $P03 = $P01->appendChild($dom->createElement('vDespAdu',    number_format($this->vDespAdu, 2, ".", "")));
        $P04 = $P01->appendChild($dom->createElement('vII',         number_format($this->vII, 2, ".", "")));
        $P05 = $P01->appendChild($dom->createElement('vIOF',        number_format($this->vIOF, 2, ".", "")));
        return $P01;
    }

}
