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
 * @package   NFePHP2
 * @name      NFeGeradorInterface
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @copyright 2014 &copy; NFePHP
 * @link      http://www.nfephp.org/
 * @author   Marcus Balbi <marcusbalbi@hotmail.com>
 *
*/

namespace NFEPHP2\NFe\XML\Retornos;


/**
 * Description of LerRetornoCCe
 *
 * @author marcus
 */
class LerRetornoCCe extends \NFEPHP2\NFe\XML\Retornos\LerRetornoAbstract {
    
    
    
    public function lerRetorno() {
        
         $retorno = array();

        $infEvento = $this->dom->getElementsByTagName("infEvento")->item(1);

        $retorno['tpAmb'] = $infEvento->getElementsByTagName("tpAmb")->item(0)->nodeValue;
        $retorno['verAplic'] = $infEvento->getElementsByTagName("verAplic")->item(0)->nodeValue;
        $retorno['cOrgao'] = $infEvento->getElementsByTagName("cOrgao")->item(0)->nodeValue;
        $retorno['cStat'] = $infEvento->getElementsByTagName("cStat")->item(0)->nodeValue;
        $retorno['xMotivo'] = $infEvento->getElementsByTagName("xMotivo")->item(0)->nodeValue;
        $retorno['chNFe'] = $infEvento->getElementsByTagName("chNFe")->item(0)->nodeValue;
        $retorno['tpEvento'] = $infEvento->getElementsByTagName("tpEvento")->item(0)->nodeValue;
        $retorno['nSeqEvento'] = $infEvento->getElementsByTagName("nSeqEvento")->item(0)->nodeValue;
        $retorno['CNPJDest'] = $infEvento->getElementsByTagName("CNPJDest")->item(0)->nodeValue;
        $retorno['emailDest'] = $infEvento->getElementsByTagName("emailDest")->item(0)->nodeValue;
        $retorno['dhRegEvento'] = $infEvento->getElementsByTagName("dhRegEvento")->item(0)->nodeValue;
        $retorno['nProt'] = $infEvento->getElementsByTagName("nProt")->item(0)->nodeValue;

        return $retorno;
        
    }

//put your code here
}
