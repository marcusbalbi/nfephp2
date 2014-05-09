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
 * @name      DI
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Produtos\Imposto;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * DI
 * Nível 4 :: I18
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class di implements NFeGeradorInterface {
    public $nDI;           // I19 - número do documento de importação DI/DSI/DA
    public $dDi;           // I20 - data da registro da DI/DSI/DA
    public $xLocDesemb;    // I21 - local de desembaraço
    public $UFDesemb;      // I22 - UF onde ocorreu o desembaraço aduaneiro
    public $dDesemb;       // I23 - data do desembaraço aduaneiro
    public $cExportador;   // I24 - código do exportador
    public $adi;           // I25 - adições

    function __construct() {
        $this->adi = array();
    }

    function addAdi($obj_adi) {
        $this->adi[] = $obj_adi;
        return $this;
    }

    public function getXml(DOMDocument $dom) {
        $I18 = $dom->appendChild($dom->createElement('DI'));
        $I19 = $I18->appendChild($dom->createElement('nDI',         $this->nDi));
        $I20 = $I18->appendChild($dom->createElement('dDi',         $this->dDi));
        $I21 = $I18->appendChild($dom->createElement('xLocDesemb',  $this->xLocDesemb));
        $I22 = $I18->appendChild($dom->createElement('UFDesemb',    $this->UFDesemb));
        $I23 = $I18->appendChild($dom->createElement('dDesemb',     $this->dDesemb));
        $I24 = $I18->appendChild($dom->createElement('cExportador', $this->cExportador));
        for ($i=0; $i<count($this->adi); $i++) {
            $I25 = $I18->appendChild($this->adi[$i]->get_xml($dom));
        }
        return $I18;
    }

}
