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
 * Description of LerRetornoInutilizacao
 *
 * @author marcus
 */
class LerRetornoInutilizacao extends LerRetornoAbstract{
    
    

    public function lerRetorno() {

        $retorno = array();

        $infInut = $this->dom->getElementsByTagName('infInut')->item(1);

        $retorno['Id'] = $infInut->getAttribute("Id");
        $retorno['tpAmb'] = $infInut->getElementsByTagName("tpAmb")->item(0)->nodeValue;
        $retorno['cUF'] = $infInut->getElementsByTagName("cUF")->item(0)->nodeValue;
        $retorno['ano'] = $infInut->getElementsByTagName("ano")->item(0)->nodeValue;
        $retorno['CNPJ'] = $infInut->getElementsByTagName("CNPJ")->item(0)->nodeValue;
        $retorno['mod'] = $infInut->getElementsByTagName("mod")->item(0)->nodeValue;
        $retorno['serie'] = $infInut->getElementsByTagName("serie")->item(0)->nodeValue;
        $retorno['nNFIni'] = $infInut->getElementsByTagName("nNFIni")->item(0)->nodeValue;
        $retorno['nNFFin'] = $infInut->getElementsByTagName("nNFFin")->item(0)->nodeValue;
        $retorno['xMotivo'] = $infInut->getElementsByTagName("xMotivo")->item(0)->nodeValue;
        $retorno['dhRecbto'] = $infInut->getElementsByTagName("dhRecbto")->item(0)->nodeValue;
        $retorno['nProt'] = $infInut->getElementsByTagName("nProt")->item(0)->nodeValue;

        return $retorno;
    }

}
