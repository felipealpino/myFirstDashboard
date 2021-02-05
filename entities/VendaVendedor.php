<?php
    
    class VendaVendedor extends Vendedor{

        private $dataVenda;
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

        
        public function getSubTotal(){
            return $this->subTotal;
        }
        public function addSubTotal($valor){
            $this->subTotal += $valor;
        }

        
    }

?>
