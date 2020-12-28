<?php

    class VendaDataValor{

        private $data_venda;
        private $valor_venda;


        function __construct($data_da_venda, $valor_da_venda){
            $this->data_venda = $data_da_venda;
            $this->valor_venda = $valor_da_venda;
        }

        public function getData_venda(){
            return $this->data_venda;
        }
        // public function setData_venda($data_da_venda){
        //     $this->data_venda = $data_da_venda;
        // }

        public function getValor_venda(){
            return $this->valor_venda;
        }
        // public function setValor_venda($valor_da_venda){
        //     $this->valor_venda = $valor_da_venda;
        // }


        
    }

?>
