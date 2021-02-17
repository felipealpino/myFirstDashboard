<?php
    require 'ProdutoVendido.php';
    require '../php_library/biblioteca.php';

    class ProdutoFactory{

        private $listaProd = array();


        public function getListaProd(){
            return $this->listaProd;
        }

        public function thisExist($codProd, $referencia, $descricao, $custo, $quantidade){
            if(count($this->listaProd) != 0){
                for($i=0; $i<count($this->listaProd); $i++){
                    if($codProd == $this->listaProd[$i]->getCodProd()){
                        $this->listaProd[$i]->addQuantidade($quantidade);
                        return true;
                    }
                }
            }
            $produto = new ProdutoVendido();
                $produto->setCodProd($codProd);
                $produto->setReferencia($referencia);
                $produto->setDescricao($descricao);
                $produto->setCusto($custo);
                $produto->addQuantidade($quantidade);
            array_push($this->listaProd, $produto);
        }


        public function valorTotal(){
            $sum = 0;
            foreach($this->listaProd as $obj){
                $sum += $obj->subtotal();
            }
            return formatNumberToReal($sum);
        }



        public function valorTotalPorFamilia($custo, $estoque, $codFamilia){
            if(count($this->listaProd) != 0){

                for($i=0; $i<count($this->listaProd); $i++){
                    if($codFamilia == $this->listaProd[$i]->getCodFamilia()){
                        $valorEmEstoque = $custo * $estoque;
                        $this->listaProd[$i]->somaValorEstoque($valorEmEstoque);
                        return true;
                    }
                }

                $produto = new Produto();
                    $produto->setCusto($custo);
                    $produto->setEstoque($estoque);
                    $produto->setCodFamilia($codFamilia);
                array_push($this->listaProd, $produto);

            } else {
                $produto = new Produto();
                    $produto->setCusto($custo);
                    $produto->setEstoque($estoque);
                    $produto->setCodFamilia($codFamilia);
                array_push($this->listaProd, $produto);
            }

        }



    }

?>