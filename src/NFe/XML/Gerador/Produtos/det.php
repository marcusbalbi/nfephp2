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
 * @name      det
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */

namespace NFEPHP2\NFe\XML\Gerador\Produtos;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use NFEPHP2\NFe\XML\Gerador\Produtos\Imposto\imposto;
use DOMDocument;

/**
 * det
 * Nível 2 :: H01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class det implements NFeGeradorInterface {
    public $nItem;     // H02 - número do item
    
    /**
     *
     * @var prod
     */
    public $prod;      // I01 - grupo do detalhamento de prod e serv da NFe
    
    /**
     *
     * @var imposto
     */
    public $imposto;   // M01 - grupo de tributos incidentes no produto ou serviço
    
    /**
     *
     * @var infAdProd 
     */
    public $infAdProd; // V01 - informações adicionais do produto

    
    function __construct() {
        $this->prod         = new prod;
        $this->imposto      = new imposto;
        $this->infAdProd    = null;
    }

    public function addInfAdProd(NFeGeradorInterface $obj_infAdProd)
    {
        if (!$this->infAdProd) {
            $this->infAdProd = $obj_infAdProd;
            return $this;
        } else {
            return false;
        }
    }

    public function getXml(DOMDocument $dom) 
    {
        $H01 = $dom->appendChild($dom->createElement('det'));
        $H02 = $H01->appendChild($dom->createAttribute('nItem'));
               $H02->appendChild($dom->createTextNode($this->nItem));
        $I01 = $H01->appendChild($this->prod->getXml($dom));
        $M01 = $H01->appendChild($this->imposto->getXml($dom));
        $V01 = (is_object($this->infAdProd)) ? $H01->appendChild($this->infAdProd->getXml($dom)) : null;
        return $H01;
    }

}
