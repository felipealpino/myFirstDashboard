<?php
    require 'Produto.php';

    class ProdutoVendido extends Produto{

        private $quantidadeVenda;


        function __construct(){
            $this->quantidadeVenda = 0;            
        }

        
        public function getQuantidade() {
            return $this->quantidadeVenda;
        }
        public function addQuantidade($quantidadeVenda){
            $this->quantidadeVenda += $quantidadeVenda;
        }


        public function subtotal(){
            return $this->quantidadeVenda * $this->getCusto();
        }

    }

?>





