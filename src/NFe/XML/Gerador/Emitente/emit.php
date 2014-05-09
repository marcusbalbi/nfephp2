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
 * @name      emit
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Emitente;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * emit
 * Nível 2 :: C01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class emit implements NFeGeradorInterface {
    
    public $CNPJ;      // C02 - CNPJ do emitente
    public $CPF;       // C02a- CPF do remetente
    public $xNome;     // C03 - razão social ou nome do emitente
    public $xFant;     // C04 - nome fantasia
    /**
     *
     * @var enderEmit
     */
    public $enderEmit; // C05 - grupo do endereço do emitente
    public $IE;        // C17 - IE
    public $IEST;      // C18 - IE do substituto tributário
    public $IM;        // C19 - Inscrição Municipal
    public $CNAE;      // C20 - CNAE fiscal
    public $CRT;        // C21 - Código de Regime Tributário 

    public function __construct() {
        $this->enderEmit = new enderEmit;
    }

    public function getXml(DOMDocument $dom) {
        $C01 = $dom->appendChild($dom->createElement('emit'));
        $C02 = (empty($this->CPF)) ? $C01->appendChild($dom->createElement('CNPJ', sprintf("%014s", $this->CNPJ))) : $C01->appendChild($dom->createElement('CPF', sprintf("%011s", $this->CPF)));
        //C02a - ou exclusivo com C02
        $C03 = $C01->appendChild($dom->createElement('xNome',       $this->xNome));
        $C04 = $C01->appendChild($dom->createElement('xFant',       $this->xFant));
        $C05 = $C01->appendChild($this->enderEmit->getXml($dom));
        $C17 = $C01->appendChild($dom->createElement('IE',          $this->IE));
        $C18 = (!empty($this->IEST)) ? $C01->appendChild($dom->createElement('IEST',    $this->IEST)) : '';
        $C19 = (!empty($this->IM)) ? $C01->appendChild($dom->createElement('IM',        $this->IM)) : '';
        $C20 = (!empty($this->CNAE) && !empty($this->IM)) ? $C01->appendChild($dom->createElement('CNAE',    $this->CNAE)) : '';
        $C21 = $C01->appendChild($dom->createElement('CRT', $this->CRT));
        return $C01;
    }

}
