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
 * @name      ide
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Nfe;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * ide
 * Nível 2 :: B01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class ide implements NFeGeradorInterface {
    public $cUF;       // B02 - código da UF do emitente
    public $cNF;       // B03 - código numérico que compõe a chave de acesso;
    public $natOp;     // B04 - descrição da natureza da operação
    public $indPag;    // B05 - indicador da forma de pagamento
    public $mod;       // B06 - código do modelo do documento fiscal
    public $serie;     // B07 - série do documento fiscal
    public $nNF;       // B08 - número do documento fiscal
    public $dEmi;      // B09 - data de emissão do documento fiscal
    public $dSaiEnt;   // B10 - data da saída ou da entrada da mercadoria/produto
    public $tpNF;      // B11 - tipo do documento fiscal (0-entrada / 1-saida)
    public $cMunFG;    // B12 - código do município de ocorrência do fato gerador
    public $NFref;     // B12a- informação das NF/NFe referenciadas
    public $tpImp;     // B21 - formato de impressão do DANFE
    public $tpEmis;    // B22 - forma de emissão da NFe
    public $cDV;       // B23 - dígito verificador da chave de acesso
    public $tpAmb;     // B24 - identificação do ambiente
    public $finNFe;    // B25 - finalidade de emissão da NFe
    public $procEmi;   // B26 - processo de emissão da NFe
    public $verProc;   // B27 - versão do processo de emissão da NFe

    function __construct() {
        $this->mod      = 55;               // NFe
        $this->NFref    = array();
        $this->procEmi  = 0;                // emissão de NFe com aplicativo do contribuinte

    }

    // NFe ou NF
    function addNFref(NFeGeradorInterface $obj_NFref) {
        $this->NFref[] = $obj_NFref;
        return $this;
    }

    public function getXml(DOMDocument $dom) {
        
        $B01 = $dom->appendChild($dom->createElement('ide'));
        $B02 = $B01->appendChild($dom->createElement('cUF',     $this->cUF));
        $B03 = $B01->appendChild($dom->createElement('cNF',     sprintf("%08d", $this->cNF)));
        $B04 = $B01->appendChild($dom->createElement('natOp',   $this->natOp));
        $B05 = $B01->appendChild($dom->createElement('indPag',  $this->indPag));
        $B06 = $B01->appendChild($dom->createElement('mod',     $this->mod));
        $B07 = $B01->appendChild($dom->createElement('serie',   $this->serie));
        $B08 = $B01->appendChild($dom->createElement('nNF',     $this->nNF));
        $B09 = $B01->appendChild($dom->createElement('dEmi',    $this->dEmi));
        $B10 = (!empty($this->dSaiEnt)) ? $B01->appendChild($dom->createElement('dSaiEnt', $this->dSaiEnt)) : '';
        $B11 = $B01->appendChild($dom->createElement('tpNF',    $this->tpNF));
        $B12 = $B01->appendChild($dom->createElement('cMunFG',  $this->cMunFG));
        
        if(is_array($this->NFref)) {
            for ($i=0; $i<count($this->NFref); $i++) {
                $B12a= $B01->appendChild($this->NFref[$i]->getXml($dom));
            }
        }
        $B21 = $B01->appendChild($dom->createElement('tpImp',   $this->tpImp));
        $B22 = $B01->appendChild($dom->createElement('tpEmis',  $this->tpEmis));
        $B23 = $B01->appendChild($dom->createElement('cDV',     $this->cDV));
        $B24 = $B01->appendChild($dom->createElement('tpAmb',   $this->tpAmb));
        $B25 = $B01->appendChild($dom->createElement('finNFe',  $this->finNFe));
        $B26 = $B01->appendChild($dom->createElement('procEmi', $this->procEmi));
        $B27 = $B01->appendChild($dom->createElement('verProc', $this->verProc));
        return $B01;
    }

}
