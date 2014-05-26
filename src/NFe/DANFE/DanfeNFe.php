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
 * @name      emit
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2009 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author    Marcus Balbi <balbimarcus@gmail.com>
 */
namespace NFEPHP2\NFe\DANFE;

class DanfeNFe extends \DanfeNFePHP {
    
    public $textoRodape = "";

    public $paginaWebRodape = "";

    public function __construct($docXML = '', $sOrientacao = '', $sPapel = '', $sPathLogo = '', $sDestino = 'I', $sDirPDF = '', $fonteDANFE = '', $exibirPIS = 1, $mododebug = 2) {
        parent::__construct($docXML, $sOrientacao, $sPapel, $sPathLogo, $sDestino, $sDirPDF, $fonteDANFE, $exibirPIS, $mododebug);
    }
    
        /**
     * __rodapeDANFE
     * Monta o rodape no final da DANFE ( retrato e paisagem )
     * @package NFePHP
     * @name __rodapeDANFE
     * @version 1.1
     * @author Roberto L. Machado <linux.rlm at gmail dot com>
     * @param number $xInic Posição horizontal canto esquerdo
     * @param number $yFinal Posição vertical final para impressão
     */
    protected function __rodapeDANFE($x,$y){
        $texto = "Impresso em  ". date('d/m/Y   H:i:s');
        $w = $this->wPrint-4;
        $aFont = array('font'=>$this->fontePadrao,'size'=>6,'style'=>'I');
        $this->__textBox($x,$y,$w,4,$texto,$aFont,'T','L',0,'');
        $texto = !empty($this->textoRodape)? $this->textoRodape : "DanfeNFePHP ver. " . $this->version .  "  Powered by NFePHP (GNU/GPLv3 GNU/LGPLv3) © www.nfephp.org";
        $aFont = array('font'=>$this->fontePadrao,'size'=>6,'style'=>'I');
        $this->__textBox($x,$y,$w,4,$texto,$aFont,'T','R',0,!empty($this->paginaInternetRodape)? $this->paginaWebRodape : 'http://www.nfephp.org');
    } //fim __rodapeDANFE
    
}
