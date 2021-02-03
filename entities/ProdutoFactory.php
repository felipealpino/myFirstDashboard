<?php
    require 'ProdutoVendido.php';
    require '../php_library/biblioteca.php';

    class ProdutoFactory{

        private $listaProd = array();


        public function getListaProd(){
            return $this->listaProd;
        }

        public function thisExist($codProd, $referencia, $descricao, $custo, $quantidade){
            $aux = 0;
            if(count($this->listaProd) != 0){

                for($i=0; $i<count($this->listaProd); $i++){
                    if($codProd == $this->listaProd[$i]->getCodProd()){
                        $this->listaProd[$i]->addQuantidade($quantidade);
                        $aux += 1;
                    }
                }

                if($aux == 0){
                    $produto = new ProdutoVendido();
                        $produto->setCodProd($codProd);
                        $produto->setReferencia($referencia);
                        $produto->setDescricao($descricao);
                        $produto->setCusto($custo);
                        $produto->addQuantidade($quantidade);
                    array_push($this->listaProd, $produto);
                }

            } else {
                $produto = new ProdutoVendido();
                    $produto->setCodProd($codProd);
                    $produto->setReferencia($referencia);
                    $produto->setDescricao($descricao);
                    $produto->setCusto($custo);
                    $produto->addQuantidade($quantidade);
                array_push($this->listaProd, $produto);
            }

        }


        public function valorTotal(){
            $sum = 0;
            foreach($this->listaProd as $obj){
                $sum += $obj->subtotal();
            }
            return formatNumberToReal($sum);
        }



    }

?>