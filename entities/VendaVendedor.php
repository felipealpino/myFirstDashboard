<?php
    
    class VendaVendedor extends Vendedor{

        private $dataVenda;
        private $valorVenda;
        private $subTotal;


        function __construct(){
            $this->subTotal = 0;
        }

        
        public function getDataVenda(){
            return $this->dataVenda;
        }
        public function setDataVenda($dataVenda){
            $this->dataVenda = $dataVenda;
        }


        // public function getValorVenda(){
        //     return $this->valorVenda;
        // }
        // public function setValorVenda($valorVenda){
        //     $this->valorVenda = $valorVenda;
        // }


        public function getSubTotal(){
            return $this->subTotal;
        }
        public function addSubTotal($valor){
            $this->subTotal += $valor;
        }


        public function getAnoDaData(){
            $arrayData = explode('-', $this->getDataVenda());
            return $arrayData[0];            
        }


        
    }

?>
