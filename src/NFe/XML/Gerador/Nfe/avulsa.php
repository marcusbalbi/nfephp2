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
 * @name      avulsa
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Nfe;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * avulsa
 * Nível 2 :: D01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class avulsa implements NFeGeradorInterface {
    public $CNPJ;      // D02 - CNPJ do órgão emitente
    public $xOrgao;    // D03 - órgão emitente
    public $matr;      // D04 - matrícula do agente
    public $xAgente;   // D05 - nome do agente
    public $fone;      // D06 - telefone
    public $UF;        // D07 - sigla da UF
    public $nDAR;      // D08 - número do documento de arrecadação de receita
    public $dEmi;      // D09 - data de emissão do documento de arrecadação
    public $vDAR;      // D10 - valor total no documento de arrecadação de receita
    public $repEmi;    // D11 - repartição fiscal emitente
    public $dPag;      // D12 - data de pagamento do documento de arrecadação

    public function __construct() 
    {
        
    }

    public function getXml(DOMDocument $dom)
    {
        
        $D01 = $dom->appendChild($dom->createElement('avulsa'));
        $D02 = $D01->appendChild($dom->createElement('CNPJ',    sprintf("%014s", $this->CNPJ)));
        $D03 = $D01->appendChild($dom->createElement('xOrgao',  $this->xOrgao));
        $D04 = $D01->appendChild($dom->createElement('matr',    $this->matr));
        $D05 = $D01->appendChild($dom->createElement('xAgente', $this->xAgente));
        $D06 = $D01->appendChild($dom->createElement('fone',    $this->fone));
        $D07 = $D01->appendChild($dom->createElement('UF',      $this->UF));
        $D08 = $D01->appendChild($dom->createElement('nDAR',    $this->nDAR));
        $D09 = $D01->appendChild($dom->createElement('dEmi',    $this->dEmi));
        $D10 = $D01->appendChild($dom->createElement('vDAR',    number_format($this->vDAR, 2, ".", "")));
        $D11 = $D01->appendChild($dom->createElement('repEmi',  $this->repEmi));
        $D12 = (!empty($this->dPag)) ? $D01->appendChild($dom->createElement('dPag', $this->dPag)) : '';
        return $D01;
    }

}
