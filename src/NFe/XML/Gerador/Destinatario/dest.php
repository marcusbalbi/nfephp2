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
 * @name      dest
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Destinatario;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;

/**
 * dest
 * Nível 2 :: E01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class dest implements NFeGeradorInterface {
    public $CNPJ;      // E02 - CNPJ do emitente
    public $CPF;       // E02a- CPF do remetente
    public $xNome;     // E03 - razão social ou nome do emitente
    /**
     *
     * @var enderDest
     */
    public $enderDest; // E05 - grupo do endereço do emitente
    public $IE;        // E17 - IE
    public $ISUF;      // E18 - Inscrição na SUFRAMA
    public $email;      //E19 - email 
            
    public function __construct() {
        $this->enderDest = new enderDest;
    }

    public function getXml(DOMDocument $dom)
    {
        $E01 = $dom->appendChild($dom->createElement('dest'));
        $E02 = (empty($this->CPF)) ? $E01->appendChild($dom->createElement('CNPJ', sprintf("%014s", $this->CNPJ))) : $E01->appendChild($dom->createElement('CPF', sprintf("%011s", $this->CPF)));
        //E03 - ou exclusivo com E02
        $E04 = $E01->appendChild($dom->createElement('xNome', $this->xNome));
        $E05 = $E01->appendChild($this->enderDest->getXml($dom));
        $E17 = $E01->appendChild($dom->createElement('IE', $this->IE));
        $E18 = (!empty($this->ISUF)) ? $E01->appendChild($dom->createElement('ISUF', $this->ISUF)) : '';
        $E19 = (!empty($this->email)) ? $E01->appendChild($dom->createElement('email', $this->email)) : '';
        return $E01;
    }

}
