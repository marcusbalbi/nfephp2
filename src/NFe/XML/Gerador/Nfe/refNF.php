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
 * @name      refNF
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Nfe;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * refNF
 * Nível 4 :: B14
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class refNF implements NFeGeradorInterface {
    public $cUF;       // B15 - código da UF do emitente do documento fiscal
    public $AAMM;      // B16 - ano e mês de emissão da NFe
    public $CNPJ;      // B17 - CNPJ do emitente
    public $mod;       // B18 - modelo do documento fiscal
    public $serie;     // B19 - série do documento fiscal
    public $nNF;       // B20 - número do documento fiscal

  public function __construct() {
    }

    public function getXml(DOMDocument $dom)
    {
        $B14 = $dom->appendChild($dom->createElement('refNF'));
        $B15 = $B14->appendChild($dom->createElement('cUF',   $this->cUF));
        $B16 = $B14->appendChild($dom->createElement('AAMM',  $this->AAMM));
        $B17 = $B14->appendChild($dom->createElement('CNPJ',  sprintf("%014s", $this->CNPJ)));
        $B18 = $B14->appendChild($dom->createElement('mod',   $this->mod));
        $B19 = $B14->appendChild($dom->createElement('serie', $this->serie));
        $B20 = $B14->appendChild($dom->createElement('nNF',   $this->nNF));
        return $B14;
    }

}
