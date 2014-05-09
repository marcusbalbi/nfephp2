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
 * @name      med
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * med
 * Nível 4 :: K01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 */
class med implements NFeGeradorInterface {
    public $nLote;     // K02 - número do lote do medicamento
    public $qLote;     // K03 - quantidade de produto no lote do medicamento
    public $dFab;      // K04 - data de fabricação
    public $dVal;      // K05 - data de validade
    public $vPMC;      // K06 - preço máximo consumidor

    function __construct()
    {
        
    }

    public function getXml(DOMDocument $dom)
    {
        $K01 = $dom->appendChild($dom->createElement('med'));
        $K02 = $K01->appendChild($dom->createElement('nLote',   $this->nLote));
        $K03 = $K01->appendChild($dom->createElement('qLote',   $this->qLote));
        $K04 = $K01->appendChild($dom->createElement('dFab',    $this->dFab));
        $K05 = $K01->appendChild($dom->createElement('dVal',    $this->dVal));
        $K06 = $K01->appendChild($dom->createElement('vPMC',    $this->vPMC));
        return $K01;
    }
}
