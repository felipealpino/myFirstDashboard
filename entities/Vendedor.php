<?php

class Vendedor{

    private $codVendedor;
    private $nomeVendedor;

    function __construct(){

    }

    public function getCodVendedor(){
        return $this->codVendedor;
    }
    public function setCodVendedor($codVendedor){
        $this->codVendedor = $codVendedor;
    }


    public function getNomeVendedor(){
        return $this->nomeVendedor;
    }
    public function setNomeVendedor($codVendedor){
        $this->nomeVendedor = findNomeVendedor($codVendedor);
    }

}



?>