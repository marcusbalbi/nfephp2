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
 * @name      infAdic
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */


namespace NFEPHP2\NFe\XML\Gerador\Adicionais;

use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use NFEPHP2\NFe\XML\Exceptions\MaximoElementosException;
use DOMDocument;
/**
 * infAdic
 * Nível 2 :: Z01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class infAdic implements NFeGeradorInterface {
    public $infAdFisco;    // Z02 - informações adicionais de interesse do fisco
    public $infCpl;        // Z03 - informações de interesse do contribuinte
    public $obsCont;       // Z04 - grupo de campo de uso livre do contribuinte
    public $obsFisco;      // Z07 - grupo de campo de uso livre do fisco
    public $procRef;       // Z10 - grupo do processo

    public function __construct() {
        $this->obsCont  = array();
        $this->obsFisco = array();
        $this->procRef  = array();
    }

  public function addObsCont(NFeGeradorInterface $obj_obsCont) {
        if (count($this->obsCont) < 10) {
            $this->obsCont[] = $obj_obsCont;
            return $this;
        } else {
            throw new MaximoElementosException("Numero Maximo de Elementos Atingido para este Elemento");
        }
    }

  public function addObsFisco(NFeGeradorInterface $obj_obsFisco) {
        if (count($this->obsFisco) < 10) {
            $this->obsFisco[] = $obj_obsFisco;
            return $this;
        } else {
             throw new MaximoElementosException("Numero Maximo de Elementos Atingido para este Elemento");
        }
    }

  public function addProcRef(NFeGeradorInterface $obj_procRef) {
        $this->procRef[] = $obj_procRef;
        return $this;
    }

    public function getXml(DOMDocument $dom)
    {
        $Z01 = $dom->appendChild($dom->createElement('infAdic'));
        $Z02 = (!empty($this->infAdFisco)) ? $Z01->appendChild($dom->createElement('infAdFisco', $this->infAdFisco)) : null;
        $Z03 = (!empty($this->infCpl)) ? $Z01->appendChild($dom->createElement('infCpl', $this->infCpl)) : null;
        for ($i = 0; $i < count($this->obsCont); $i++) {
            $Z04 = $Z01->appendChild($this->obsCont[$i]->getXml($dom));
        }
        for ($i = 0; $i < count($this->obsFisco); $i++) {
            $Z07 = $Z01->appendChild($this->obsFisco[$i]->getXml($dom));
        }
        for ($i = 0; $i < count($this->procRef); $i++) {
            $Z10 = $Z01->appendChild($this->procRef[$i]->getXml($dom));
        }
        return $Z01;
    }

}
