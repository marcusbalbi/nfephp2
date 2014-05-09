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
 * @name      transp
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 */
namespace NFEPHP2\NFe\XML\Gerador\Transportadora;
use NFEPHP2\NFe\XML\Gerador\NFeGeradorInterface;
use DOMDocument;
/**
 * transp
 * Nível 2 :: W01
 *
 * @author  Djalma Fadel Junior <dfadel@ferasoft.com.br>
 *          Marcus Vinicius Balbi <marcusbalbi@hotmail.com>
 */
class transp implements NFeGeradorInterface {
    public $modFrete;      // X02 - modalidade do frete
    
    /**
     *
     * @var transporta
     */
    public $transporta;    // X03 - grupo transportador
    public $retTransp;     // X11 - grupo de retenção do ICMS do transporte
    
    /**
     *
     * @var veicTransp
     */
    public $veicTransp;    // X18 - grupo veículo
    public $reboque;       // X22 - grupo reboque
    
    /**
     *
     * @var vol um array de vol
     */
    public $vol;           // X26 - grupo volumes

    public function __construct()
    {
        $this->transporta   = new transporta;
        $this->retTransp    = null;
        $this->veicTransp   = new veicTransp;
        $this->reboque      = array();
        $this->vol          = array();
    }

    public function addTransporta(NFeGeradorInterface $obj_transporta)
    {
        if (!$this->transporta) {
            $this->transporta = $obj_transporta;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addRetTransp(NFeGeradorInterface $obj_retTransp)
    {
        if (!$this->retTransp) {
            $this->retTransp = $obj_retTransp;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addVeicTransp(NFeGeradorInterface $obj_veicTransp)
    {
        if (!$this->veicTransp) {
            $this->veicTransp = $obj_veicTransp;
            return $this;
        } else {
            return false;
        }
    }
    
    public function addReboque(NFeGeradorInterface $obj_reboque)
    {
        if (count($this->reboque) < 2) {
            $this->reboque[] = $obj_reboque;
            return $this;
        } else {
            return false;
        }
    }

    public function addVol(NFeGeradorInterface $obj_vol)
    {
        $this->vol[] = $obj_vol;
        return $this;
    }

    public function getXml(DOMDocument $dom)
    {
        $X01 = $dom->appendChild($dom->createElement('transp'));
        $X02 = $X01->appendChild($dom->createElement('modFrete', $this->modFrete));
        $X03 = (is_object($this->transporta)) ? $X01->appendChild($this->transporta->getXml($dom)) : null;
        $X11 = (is_object($this->retTransp))  ? $X01->appendChild($this->retTransp->getXml($dom))  : null;
        $X18 = (is_object($this->veicTransp)) ? $X01->appendChild($this->veicTransp->getXml($dom)) : null;
        if(is_array($this->reboque)) {
            for ($i=0; $i<count($this->reboque); $i++) {
                $X22 = $X01->appendChild($this->reboque[$i]->getXml($dom));
            }
        }
        
        if(is_array($this->vol)) {
            for ($i=0; $i<count($this->vol); $i++) {
                $X26 = $X01->appendChild($this->vol[$i]->getXml($dom));
            }
        }
        
        return $X01;
    }

}
