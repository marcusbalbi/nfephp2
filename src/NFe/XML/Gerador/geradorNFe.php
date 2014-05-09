<?php


namespace NFEPHP2\NFe\XML\Gerador;
use NFEPHP2\NFe\XML\Gerador\Nfe\infNFe;
use NFEPHP2\NFe\XML\Gerador\Nfe\ide;
use NFEPHP2\NFe\XML\Gerador\Emitente\emit;
use NFEPHP2\NFe\XML\Gerador\Destinatario\dest;
use NFEPHP2\NFe\XML\Gerador\Produtos\det;
use NFEPHP2\NFe\XML\Gerador\Totais\total;
use NFEPHP2\NFe\XML\Gerador\Cobranca\cobr;
use NFEPHP2\NFe\XML\Gerador\Adicionais\infAdic;
use NFEPHP2\NFe\XML\Gerador\Transportadora\transp;
use DOMDocument;
use NfeGeradorException;

class geradorNFe {
    
    /**
     *
     * @var infNFe
     */
    public $infNfe;

    /**
     *
     * @var ide
     */
    public $ide;

    /**
     *
     * @var emit
     */
    public $emit;
    
    /**
     *
     * @var dest
     */
    public $dest;
    
    /**
     *
     * @var det
     */
    public $det = array();
    
    /**
     *
     * @var total
     */
    public $total;
    
    /**
     *
     * @var transp
     */
    public $transp;


    /**
     *
     * @var cobr
     */
    public $cobr;
    
    /**
     *
     * @var infAdic
     */
    public $infAdic;

    
    public function __construct() {
      
        $this->ide = new ide();  
        $this->emit =  new emit();  
        $this->dest = new dest();  
        $this->det =  array();  
        $this->total =  new total();  
        $this->transp =  new transp();  
        $this->cobr = new cobr();  
        $this->infAdic = new infAdic();
        $this->infNfe = new infNFe();
    }
    
    /**
     * @return DOMDocument Description
     */
    public function gerar()
    {
        try
        {
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->formatOutput = true;
            $dom->preserveWhiteSpace = false;
            $nfe = $dom->createElement("NFe");
            $nfe->setAttribute("xmlns", "http://www.portalfiscal.inf.br/nfe");

            $this->infNfe = new infNFe();

            $this->infNfe->versao = "2.00";
            $this->infNfe->addIde($this->ide);
            $this->infNfe->addEmit($this->emit);
            $this->infNfe->addDest($this->dest);
            $this->infNfe->addTotal($this->total);
            $this->infNfe->addTransp($this->transp);        
            $this->infNfe->addCobr($this->cobr);
            $this->infNfe->addInfAdic($this->infAdic);

            foreach ($this->det as $det)
            {
                $this->infNfe->addDet($det);
            }

            $nfe->appendChild($this->infNfe->getXml($dom));

            $dom->appendChild($nfe);

            return $dom->saveXML();
        }
        catch(Exception $e)
        {           
            throw new NfeGeradorException("Erro ao Gerar NFE");
        }
        
        
    }
    
        }
