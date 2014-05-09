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
 * @name      obsFisco
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Adicionais;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMElement;
/**
 * obsFisco
 * Nível 3 :: Z07
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class obsFisco implements NFeGeradorInterface {
    
    public $xCampo;    // Z08 - identificação do campo
    public $xTexto;    // Z09 - conteúdo do campo

  public function __construct($xCampo,$xTexto)
    {
        $this->xCampo = $xCampo;
        $this->xTexto = $xTexto;
    }

    public function getXml(DOMElement $dom)
    {
        $Z07 = $dom->appendChild($dom->createElement('obsFisco'));
        $Z08 = $Z07->appendChild($dom->createElement('xCampo', $this->xCampo));
        $Z09 = $Z07->appendChild($dom->createElement('xTexto', $this->xTexto));
        return $Z07;
    }

}
