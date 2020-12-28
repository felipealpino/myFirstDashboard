<?php

// require 'VendasDataValor.php';

class Vendedor{

    private $codVendedor;
    private $vendaDataAndValor;


    function __construct($codVendedor, $vendaDataAndValor){
        $this->codVendedor = $codVendedor;
        $this->addVendaDataValor($vendaDataAndValor[0],$vendaDataAndValor[1]);
    }

    public function addVendaDataValor($data, $valor){
        $this->vendaDataAndValor = new VendaDataValor($data,$valor);
    }


    public function getCodVendedor(){
        return $this->codVendedor;
    }
    // public function setCodVendedor($cod_do_vendedor){
    //     $this->$codVendedor = $cod_do_vendedor;
    // }

    public function getVendaDataAndValor(){
        return $this->vendaDataAndValor;
    }
    // public function setVendaDataAndValor($valor_da_venda){
    //     $this->$vendaDataAndValor = $valor_da_venda;
    // }


}



?>